<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notifikasi;
use App\Models\TampilanPenggunaMasjid\RunningText;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');

         View::composer('layouts.runningText', function ($view) {
            $view->with('runningText', RunningText::latest()->first());
        });

        View::composer('*', function ($view) {
            if (Schema::hasTable('notifikasis')) {
                $view->with('notifCount', Notifikasi::count());
            } else {
                $view->with('notifCount', 0);
            }
        });
    }
}
