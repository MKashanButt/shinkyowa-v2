<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class StockTotalProvider extends ServiceProvider
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
        $url = config('services.api.url') . '/stock/totalStock';

        $total = cache()->remember('total_stock', 60, function () use ($url) {
            return Http::api()->get($url)->json();
        });

        View::composer('*', function ($view) use ($total) {
            $view->with('total', $total);
        });
    }
}
