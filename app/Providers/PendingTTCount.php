<?php

namespace App\Providers;

use App\Models\Payment;
use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PendingTTCount extends ServiceProvider
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
        if (Schema::hasTable('payments')) {
            $ttcount = Payment::where('status', false)
                ->count();

            View::composer('*', function ($view) use ($ttcount) {
                $view->with('ttcount', $ttcount);
            });
        }
    }
}
