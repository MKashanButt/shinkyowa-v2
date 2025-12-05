<?php

namespace App\Providers;

use App\Models\BodyType;
use App\Models\Make;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MakeAndBodyTypeVehicleCountProvider extends ServiceProvider
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
        $makes = Make::withCount('stock')
            ->orderBy('name')
            ->get()
            ->mapWithKeys(function ($make) {
                return [
                    $make->name => $make->stock_count
                ];
            });

        $bodytype = BodyType::withCount('stock')
            ->orderBy('name')
            ->get()
            ->mapWithKeys(function ($bodytype) {
                return [
                    $bodytype->name => $bodytype->stock_count
                ];
            });

        $count = $makes->union($bodytype);

        View::composer('*', function ($view) use ($count) {
            $view->with('count', $count);
        });
    }
}
