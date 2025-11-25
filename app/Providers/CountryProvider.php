<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CountryProvider extends ServiceProvider
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
        $url = config('services.api.url') . '/stock/country/count';

        $country = cache()->remember('country_count', 60, function () use ($url) {
            return Http::api()->get($url)->json();
        });

        View::composer('*', function ($view) use ($country) {
            $view->with('country', $country);
        });
    }
}
