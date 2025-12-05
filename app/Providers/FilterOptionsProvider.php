<?php

namespace App\Providers;

use App\Models\Make;
use App\Models\Stock;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FilterOptionsProvider extends ServiceProvider
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
        $filterOptions = [
            'make' => Make::distinct()->get(),
            'model' => Stock::select('model')->distinct()->get(),
            'year' => Stock::select('year')->distinct()->orderBy('year', 'ASC')->get(),
        ];

        View::composer('*', function ($view) use ($filterOptions) {
            $view->with('filterOptions', $filterOptions);
        });
    }
}
