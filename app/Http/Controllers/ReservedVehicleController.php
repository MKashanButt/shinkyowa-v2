<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservedVehicleRequest;
use App\Models\CustomerAccount;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservedVehicleController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('customerAccount')
            ->whereNotNull('customer_account_id')
            ->when(Auth::user()->hasPermission('view_team_reserved_vehicles'), function ($query) {
                $managerAgentIds = User::where('manager_id', Auth::id())
                    ->whereHas('role', fn($r) => $r->where('name', 'agent'))
                    ->pluck('id');

                $managerAgentIds[] = Auth::id();

                $query->whereHas('customerAccount', function ($q) use ($managerAgentIds) {
                    $q->whereIn('agent_id', $managerAgentIds);
                });
            })
            ->when(Auth::user()->hasPermission('view_own_reserved_vehicles'), function ($query) {
                $query->whereHas('customerAccount', function ($q) {
                    $q->where('agent_id', Auth::id());
                });
            })
            ->paginate(8);

        return view('admin.reserved-vehicle.index', compact('stocks'));
    }

    public function create()
    {
        $customerAccounts = CustomerAccount::when(Auth::user()->hasPermission('view_team_reserved_vehicles'), function ($query) {
            $managerAgentIds = User::where('manager_id', Auth::id())
                ->whereHas('role', function ($r) {
                    $r->where('name', 'agent');
                })
                ->pluck('id')
                ->push(Auth::id());

            $query->whereIn('agent_id', $managerAgentIds);
        })
            ->when(Auth::user()->hasPermission('view_own_reserved_vehicles'), function ($query) {
                $query->where('agent_id', Auth::id());
            })
            ->pluck('name', 'id');

        return view('admin.reserved-vehicle.create', compact('customerAccounts'));
    }

    public function store(StoreReservedVehicleRequest $request)
    {
        $validated = $request->validated();

        try {
            Stock::where('sid', $validated['sid'])
                ->update([
                    'customer_account_id' => $validated['customer_account_id'],
                    'cnf' => $validated['cnf']
                ]);

            return redirect()->route('reserved-vehicle.index')
                ->with('success', 'Vehicle reserved successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    public function edit(Stock $reserved)
    {
        $stocks = Stock::whereDoesntHave('customerAccount')
            ->get();
        $customerAccounts = CustomerAccount::when(Auth::user()->hasPermission('view_team_reserved_vehicles'), function ($query) {
            $managerAgentIds = User::where('manager_id', Auth::id())
                ->where('role', 'agent')
                ->pluck('id');

            $query->whereHas('customerAccount', function ($q) use ($managerAgentIds) {
                $q->whereIn('agent_id', $managerAgentIds);
            });
        })
            ->when(Auth::user()->hasPermission('view_own_reserved_vehicles'), function ($query) {
                $query->whereHas('customerAccount', function ($q) {
                    $q->where('agent_id', Auth::id());
                });
            })
            ->get(['cnf', 'name', 'id']);

        return view('admin.reserved-vehicle.edit', compact(
            'reserved',
            'stocks',
            'customerAccounts'
        ));
    }

    public function update(StoreReservedVehicleRequest $request, Stock $reserved)
    {
        $validated = $request->validated();

        try {
            Stock::where('id', $reserved->id)
                ->update([
                    'customer_account_id' => $validated['customer_account_id'],
                    'cnf' => $validated['cnf']
                ]);

            return redirect()->route('reserved-vehicle.index')
                ->with('success', 'Vehicle reservation updated successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy($reserved)
    {
        try {
            Stock::where('id', $reserved)
                ->update(['customer_account_id' => null, 'cnf' => 0]);

            return redirect()->route('reserved-vehicle.index')
                ->with('success', 'Vehicle reservation cancelled successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}
