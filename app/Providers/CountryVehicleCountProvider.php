<?php

namespace App\Providers;

use App\Models\Country;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CountryVehicleCountProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $country = Country::withCount('stock')
            ->orderBy('name')
            ->get()
            ->mapWithKeys(function ($country) {
                return [
                    $country->name => $country->stock_count,
                ];
            });

        View::composer('*', function ($view) use ($country) {
            $view->with('country', $country);
        });
    }
}
