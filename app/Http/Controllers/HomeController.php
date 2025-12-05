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
            ->get();

        $groupedStocks = $allStocks->groupBy(function ($stock) {
            return trim($stock->category->name ?? 'Uncategorized');
        });

        $data = $groupedStocks->map(function ($group) {
            return $group->take(8);
        });

        return view('web.index', compact('data'));
    }
}
