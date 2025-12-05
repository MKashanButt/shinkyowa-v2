<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerAccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservedVehicleController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\MakeController;
use App\Http\Controllers\NotifcationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PendingTTController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockRenderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebStockPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::controller(WebStockPageController::class)->group(function () {
    Route::get('/stock', 'index');
    Route::get('/vehicle-info/{id}', 'show');

    Route::get('/filter', 'filter');

    Route::get('/make/{make}', 'stockMakeFilter');
    Route::get('/type/{type}', 'stockBodyTypeFilter');
    Route::get('/country/{country}', 'stockCountryFilter');
    Route::get('/category/{category}', 'filterCategory');

    Route::get('/stock-search', 'search');

    Route::get('/get-models', 'getModels');
    Route::get('/get-fueltype', 'getFueltype');
    Route::get('/get-years', 'getYears');
    Route::get('/remove-year', 'yearRemove');
});

Route::view('/services/shipping', 'shipping');
Route::view('/about-us/company-profile', 'company-profile');
Route::view('/about-us/why-choose-us', 'why-choose-us');
Route::view('/sales-and-bank-details', 'bank-details');

Route::middleware(['auth', 'customerRoleCheck'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('customer-account', CustomerAccountController::class);
        Route::post('customer-account/email', [CustomerAccountController::class, 'searchByEmail'])
            ->name('customer-account.searchByEmail');
        Route::post('customer-account/company', [CustomerAccountController::class, 'searchByCompany'])
            ->name('customer-account.searchByCompany');

        Route::resource('reserved-vehicle', ReservedVehicleController::class);

        Route::resource('stock', StockController::class);
        Route::post('stock/search', [StockController::class, 'search'])
            ->name('stock.search');

        Route::resource('shipment', ShipmentController::class);
        Route::resource('document', DocumentController::class);
        Route::resource('payment', PaymentController::class);
        Route::resource('pending-tt', PendingTTController::class);

        Route::middleware(['permission:view_settings'])->group(function () {
            Route::resource('make', MakeController::class);
            Route::resource('category', CategoryController::class);
            Route::resource('currency', CurrencyController::class);
            Route::resource('inquiry', InquiryController::class);
            Route::resource('country', CountryController::class);
            Route::resource('user', UserController::class);
            Route::resource('permission', PermissionController::class);
        });

        Route::resource('notification', NotifcationController::class)
            ->middleware(['permission:view_notifications']);
    });

require __DIR__ . '/auth.php';
