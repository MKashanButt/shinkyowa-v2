<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerAccountRequest;
use App\Http\Requests\UpdateCustomerAccountRequest;
use App\Models\Country;
use App\Models\Currency;
use App\Models\CustomerAccount;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerAccountController extends Controller
{
    public function index()
    {
        $accounts = CustomerAccount::with(['currency', 'agent'])
            ->addSelect([
                'buying' => Stock::selectRaw('COALESCE(SUM(fob), 0)')
                    ->whereColumn('customer_account_id', 'customer_accounts.id'),

                'deposit' => Payment::selectRaw('COALESCE(SUM(amount), 0)')
                    ->whereColumn('customer_account_id', 'customer_accounts.id')
            ])
            ->when(Auth::user()->hasPermission('view_team_customers'), function ($query) {
                $managerAgentIds = User::where('manager_id', Auth::id())
                    ->where('role', 'agent')
                    ->pluck('id');
                $query->whereIn('agent_id', $managerAgentIds);
            })
            ->when(Auth::user()->hasPermission('view_own_customers'), function ($query) {
                $query->where('agent_id', Auth::id());
            })
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('admin.customer-account.index', compact('accounts'));
    }

    public function create()
    {
        $countries = Country::pluck('name', 'id');

        $agentUsers = User::whereHas('role', function ($q) {
            $q->where('name', 'agent');
        })->pluck('name', 'id');

        $managerUsers = User::whereHas('role', function ($q) {
            $q->where('name', 'managers');
        })->pluck('name', 'id');

        $overallUsers = $managerUsers->union($agentUsers);

        $currencies = Currency::pluck('code', 'id');
        $customerIdLatest = CustomerAccount::latest()->value('cid');
        $customerId = $customerIdLatest ? $customerIdLatest + 1 : 1;

        return view('admin.customer-account.create', compact(
            'countries',
            'customerId',
            'overallUsers',
            'currencies'
        ));
    }

    public function store(StoreCustomerAccountRequest $request,)
    {
        $validated = $request->validated();

        $customerIdLatest = CustomerAccount::latest()->value('cid');
        $customerId = $customerIdLatest ? $customerIdLatest + 1 : 1;

        CustomerAccount::create([
            'cid'         => $customerId,
            'name'        => $validated['name'],
            'company'     => $validated['company'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'],
            'whatsapp'    => $validated['whatsapp'],
            'description' => $validated['description'] ?? null,
            'address'     => $validated['address'],
            'city'        => $validated['city'],
            'country_id'  => $validated['country_id'],
            'currency_id' => $validated['currency_id'],
            'agent_id'    => $validated['agent_id'] ?? Auth::id(),
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role_id'     => 4,
        ]);

        Notification::create([
            'message' => 'New customer account created: ' . $validated['name'] . ' by ' . Auth::user()->name,
            'type'    => 'success',
        ]);

        return redirect()->route('customer-account.index')
            ->with('success', 'Customer account created successfully.');
    }

    public function show(CustomerAccount $customerAccount)
    {
        $id = $customerAccount->id;
        $customerAccount->load([
            'currency:id,symbol,code',
            'country:id,name',
            'agent:id,name',
            'stock' => function ($query) use ($id) {
                $query->with('make', 'currency', 'shipment', 'payment')
                    ->where('customer_account_id', $id)
                    ->orderBy('created_at', 'desc');
            },
            'payment' => function ($query) {
                $query->with(['stock:id,sid'])
                    ->orderBy('payment_date', 'desc')
                    ->select([
                        'id',
                        'customer_account_id',
                        'stock_id',
                        'payment_date',
                        'description',
                        'amount',
                        'in_yen',
                        'payment_recieved_date',
                        'status',
                        'file',
                    ]);
            }
        ]);

        $customerAccount->buying = $customerAccount->stock->sum('fob');
        $customerAccount->deposit = $customerAccount->payment->sum('amount');

        $customerAccount->remaining_balance = $customerAccount->buying - $customerAccount->deposit;
        $customerAccount->payment_count = $customerAccount->payment->count();
        $customerAccount->reserved_stock_count = $customerAccount->stock->count();

        return view('admin.customer-account.show', compact('customerAccount'));
    }

    public function edit(CustomerAccount $customerAccount)
    {
        $countries = Country::pluck('name', 'id');

        $agentUsers = User::whereHas('role', function ($q) {
            $q->where('name', 'agent');
        })->pluck('name', 'id');

        $managerUsers = User::whereHas('role', function ($q) {
            $q->where('name', 'managers');
        })->pluck('name', 'id');

        $overallUsers = $managerUsers->union($agentUsers);

        $currencies = Currency::pluck('code', 'id');

        return view('admin.customer-account.edit', compact(
            'customerAccount',
            'countries',
            'overallUsers',
            'currencies'
        ));
    }

    public function update(UpdateCustomerAccountRequest $request, CustomerAccount $customerAccount)
    {
        $validated = $request->validated();

        $customerAccount->update([
            'name'        => $validated['name'],
            'company'     => $validated['company'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'],
            'whatsapp'    => $validated['whatsapp'],
            'description' => $validated['description'] ?? null,
            'address'     => $validated['address'],
            'city'        => $validated['city'],
            'country_id'  => $validated['country_id'],
            'currency_id' => $validated['currency_id'],
            'agent_id'    => $validated['agent_id'] ?? Auth::id(),
        ]);

        $user = User::where('email', $customerAccount->getOriginal('email'))->first();

        if ($user) {
            $userData = [
                'name'  => $validated['name'],
                'email' => $validated['email'],
            ];

            if (!empty($validated['password'])) {
                $userData['password'] = bcrypt($validated['password']);
            }

            $user->update($userData);
        }

        Notification::create([
            'message' => 'Customer Account edited: ' . $validated['name'] . ' by ' . Auth::user()->name,
            'type'    => 'success',
        ]);

        return redirect()->route('customer-account.index')
            ->with('success', 'Customer account updated successfully.');
    }

    public function searchByEmail(Request $request)
    {
        $email = $request->input('email');
        $customerAccount = CustomerAccount::with('currency', 'agent')
            ->where('email', $email)
            ->first();

        if ($customerAccount) {
            return redirect()->route('customer-account.show', $customerAccount->id);
        } else {
            return redirect()->route('customer-account.index')
                ->with('error', 'Customer account not found.');
        }
    }

    public function searchByCompany(Request $request)
    {
        $company = $request->input('company');
        $customerAccount = CustomerAccount::where('company', 'like', '%' . $company . '%')
            ->with(['currency', 'agent'])
            ->first();

        if ($customerAccount) {
            return redirect()->route('customer-account.show', $customerAccount->id);
        } else {
            return redirect()->route('customer-account.index')
                ->with('error', 'No customer accounts found for the specified company.');
        }
    }

    public function destroy(CustomerAccount $customerAccount)
    {
        if (Auth::check() && !Auth::user()->hasPermission('can_delete_customer')) {
            return abort(403, 'Unauthorized action.');
        }

        DB::transaction(function () use ($customerAccount) {
            $customerAccount->stock()->delete();
            $customerAccount->payment()->delete();
            $customerAccount->delete();

            $user = User::where('email', $customerAccount->email)->first();
            if ($user) {
                $user->delete();
            }
        });

        Notification::create([
            'message' => 'Customer Account deleted: ' . $customerAccount->name . ' by ' . Auth::user()->name,
            'type'    => 'danger',
        ]);

        return redirect()->route('customer-account.index')
            ->with('success', 'Customer account deleted successfully.');
    }
}
