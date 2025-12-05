<?php

namespace App\Providers;

use App\Models\Stock;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class VODProvider extends ServiceProvider
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
        $vehicleOfDay = Stock::with('make', 'bodyType', 'category', 'currency', 'country')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();

        View::composer('*', function ($view) use ($vehicleOfDay) {
            $view->with('vehicleOfDay', $vehicleOfDay);
        });
    }
}
