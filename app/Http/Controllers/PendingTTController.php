<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PendingTTController extends Controller
{
    public function index()
    {
        $payments = Payment::with('customerAccount', 'stock', 'user')
            ->where('status', 'not approved')
            ->when(Auth::user()->hasPermission('view_team_payments'), function ($query) {
                $managerAgentIds = User::where('manager_id', Auth::id())
                    ->where('role', 'agent')
                    ->pluck('id');

                $query->whereIn('user_id', $managerAgentIds);
            })
            ->when(Auth::user()->hasPermission('view_own_payments'), function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->paginate(8);

        return view('admin.pending-tt.index', compact('payments'));
    }
}
