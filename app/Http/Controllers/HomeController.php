<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $allStocks = Stock::with('make', 'bodyType', 'category', 'currency', 'country')
            ->orderBy('id', 'DESC')
            ->limit(15)
            ->get();

        $newArrival = Stock::with('make', 'bodyType', 'category', 'currency', 'country')
            ->whereHas('category', fn($r) => $r->where('name', 'New Arrival'))
            ->orderBy('id', 'DESC')
            ->limit(15)
            ->get();

        $discounted = Stock::with('make', 'bodyType', 'category', 'currency', 'country')
            ->whereHas('category', fn($r) => $r->where('name', 'Discounted'))
            ->orderBy('id', 'DESC')
            ->limit(15)
            ->get();

        $commercial = Stock::with('make', 'bodyType', 'category', 'currency', 'country')
            ->whereHas('category', fn($r) => $r->where('name', 'Commercial'))
            ->orderBy('id', 'DESC')
            ->limit(15)
            ->get();

        $data = [
            "New Arrival" => $newArrival,
            "Discounted" => $discounted,
            "Commercial" => $commercial,
            "All" => $allStocks
        ];

        return view('web.index', compact('data'));
    }
}
