<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class StockController extends Controller
{
    public function index()
    {
        $page = request()->query('page', 1);

        $url = config('services.api.url') . '/stock/all';
        $response = Http::api()->get($url, [
            'page' => $page
        ])->json();

        $vehicles = $response['data'];

        $paginator = new LengthAwarePaginator(
            $vehicles,
            $response['total'],
            $response['per_page'],
            $response['current_page'],
            ['path' => request()->url()] // <-- FIX
        );

        $url = config('services.api.url') . '/stock/filterOptions';
        $filterOptions = Http::api()->get($url)->json();

        $totalvehicles = count($vehicles);
        $msg = $totalvehicles === 0;

        return view('stock', compact('paginator', 'filterOptions', 'totalvehicles', 'msg'));
    }

    public function show($id)
    {
        $url = config('services.api.url') . '/stock/single/' . $id;
        $vehicle = Http::api()->get($url)->json();

        return view('vehicle-info', compact('vehicle'));
    }
}
