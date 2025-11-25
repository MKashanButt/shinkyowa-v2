<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $url = config('services.api.url') . '/stock/byCategory';
        $data = Http::api()->get($url)->json();

        return view('index', compact('data'));
    }
}
