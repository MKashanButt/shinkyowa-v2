<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class StockController extends Controller
{
    public function index()
    {
        $url = config('services.api.url') . '/stock/all';
        $response = Http::api()->get($url)->json();

        $vehicles = $response['data'];
        $pagination = $response;

        $paginator = new LengthAwarePaginator(
            $vehicles,
            $response['total'],        // total items
            $response['per_page'],     // per page
            $response['current_page'], // current page
            ['path' => $response['path']]
        );

        $url = config('services.api.url') . '/stock/filterOptions';
        $filterOptions = Http::api()->get($url)->json();

        $totalvehicles = count($vehicles);
        $msg = $totalvehicles > 0 ? false : true;

        return view('stock', compact('paginator', 'filterOptions', 'totalvehicles', 'msg'));
    }

    public function show($id)
    {
        $url = config('services.api.url') . '/stock/single/' . $id;
        $vehicle = Http::api()->get($url)->json();

        return view('vehicle-info', compact('vehicle'));
    }
}
