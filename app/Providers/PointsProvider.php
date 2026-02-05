<?php

namespace App\Providers;

use App\Models\Point;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PointsProvider extends ServiceProvider
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
        View::composer('*', function ($view) {
            // ...and move it INSIDE the function.
            if (Auth::check() && Auth::user()->hasRole('customer')) {
                $points = Point::where('customer_account_id', Auth::id())->value('points');
                $view->with('points', $points ?? 0);
            } else {
                // It's important to provide a default value so the view doesn't crash
                $view->with('points', 0);
            }
        });
    }
}
