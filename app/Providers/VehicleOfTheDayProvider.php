<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class VehicleOfTheDayProvider extends ServiceProvider
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
        $url = config('services.api.url') . '/stock/vehicleOfTheDay';

        $vehicleOfTheDay = cache()->remember('vehicle_of_the_Day', 60, function () use ($url) {
            return Http::api()->get($url)->json();
        });

        View::composer('*', function ($view) use ($vehicleOfTheDay) {
            $view->with('vehicleOfDay', $vehicleOfTheDay);
        });
    }
}
