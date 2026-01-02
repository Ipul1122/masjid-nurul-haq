<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notifikasi;
use App\Models\TampilanPenggunaMasjid\RunningText;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

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
        // Set Carbon locale from app config and ensure PHP LC_TIME is set for date formatting
        Carbon::setLocale(config('app.locale'));
        // Try multiple locale variants for compatibility on different systems
        setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'id');

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

        Paginator::useTailwind();
        
    }
}
