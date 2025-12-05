<?php

namespace App\Providers;

use App\Models\Stock;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class StockCountProvider extends ServiceProvider
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
        if (Schema::hasTable('stocks')) {
            $total = Stock::count();

            View::composer('*', function ($view) use ($total) {
                $view->with('total', $total);
            });
        }
    }
}
