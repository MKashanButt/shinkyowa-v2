<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AllMakesProvider extends ServiceProvider
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
        $url = config('services.api.url') . '/stock/makes';

        $allMake = cache()->remember('makes', 60, function () use ($url) {
            return Http::api()->get($url)->json();
        });

        View::composer('*', function ($view) use ($allMake) {
            $view->with('allmake', $allMake);
        });
    }
}
