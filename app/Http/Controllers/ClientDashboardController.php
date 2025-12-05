<?php

namespace App\Http\Controllers;

use App\Models\CustomerAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $accountInfo = CustomerAccount::where('email', Auth::user()->email)
            ->get()
            ->first();

        return view('client.dashboard', compact('accountInfo'));
    }
}
