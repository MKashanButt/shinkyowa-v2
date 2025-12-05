<?php

namespace App\Providers;

use App\Models\Make;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AllMakeProvider extends ServiceProvider
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
        $allMake = cache()->remember('makes', 60, function () {
            return Make::all();
        });

        View::composer('*', function ($view) use ($allMake) {
            $view->with('allmake', $allMake);
        });
    }
}
