<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/stock', [StockController::class, 'index']);
Route::get('/vehicle-info/{id}', [StockController::class, 'show']);

Route::view('/services/shipping', 'shipping');
Route::view('/about-us/company-profile', 'company-profile');
Route::view('/about-us/why-choose-us', 'why-choose-us');
Route::view('/sales-and-bank-details', 'bank-details');
