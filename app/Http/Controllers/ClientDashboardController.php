<?php

namespace App\Http\Controllers;

use App\Models\CustomerAccount;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $customerAccount = CustomerAccount::whereEmail(Auth::user()->email)->firstOrFail();

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

        $customerAccount->buying = $customerAccount->stock->sum('cnf');
        $customerAccount->deposit = $customerAccount->payment->sum('amount');

        $customerAccount->remaining_balance = $customerAccount->buying - $customerAccount->deposit;
        $customerAccount->payment_count = $customerAccount->payment->count();
        $customerAccount->reserved_stock_count = $customerAccount->stock->count();

        return view('admin.customer-account.show', compact('customerAccount'));
    }
}
