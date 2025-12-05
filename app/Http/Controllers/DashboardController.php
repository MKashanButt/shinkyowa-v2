<?php

namespace App\Http\Controllers;

use App\Models\CustomerAccount;
use App\Models\Payment;
use App\Models\Stock;
use App\Models\User;
use App\Notifications\CustomerAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
            ->limit(10)
            ->get();

        $payments = Payment::with('customerAccount')
            ->when(Auth::user()->hasPermission('view_team_customers'), function ($query) {
                $managerAgentIds = User::where('manager_id', Auth::id())
                    ->where('role', 'agent')
                    ->pluck('id');

                $query->whereHas('customerAccount', function ($q) use ($managerAgentIds) {
                    $q->whereIn('agent_id', $managerAgentIds);
                });
            })
            ->when(Auth::user()->hasPermission('view_own_customers'), function ($query) {
                $query->whereHas('customerAccount', function ($q) {
                    $q->where('agent_id', Auth::id());
                });
            })
            ->orderBy('id', 'DESC')
            ->limit(4)
            ->get();


        $pendingTT = Payment::with('customerAccount')
            ->where('status', 'not approved')
            ->when(Auth::user()->hasPermission('view_team_customers'), function ($query) {
                $managerAgentIds = User::where('manager_id', Auth::id())
                    ->where('role', 'agent')
                    ->pluck('id');

                $query->whereHas('customerAccount', function ($q) use ($managerAgentIds) {
                    $q->whereIn('agent_id', $managerAgentIds);
                });
            })
            ->when(Auth::user()->hasPermission('view_own_customers'), function ($query) {
                $query->whereHas('customerAccount', function ($q) {
                    $q->where('agent_id', Auth::id());
                });
            })
            ->orderBy('id', 'DESC')
            ->limit(4)
            ->get();


        return view('admin.dashboard', compact('accounts', 'payments', 'pendingTT'));
    }
}
