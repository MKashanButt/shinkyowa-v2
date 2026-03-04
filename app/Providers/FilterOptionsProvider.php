<?php

namespace App\Providers;

use App\Models\BodyType;
use App\Models\Country;
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
            'bodytype' => BodyType::select('name')->get(),
            'year' => Stock::select('year')->distinct()->orderBy('year', 'ASC')->get(),
            'country' => Country::select('name')->distinct()->get(),
        ];

        View::composer('*', function ($view) use ($filterOptions) {
            $view->with('filterOptions', $filterOptions);
        });
    }
}
