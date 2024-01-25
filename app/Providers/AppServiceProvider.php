<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap();
        //set time zone
        $setting = Setting::first();
        if (isset($setting)) {
            Config::set('app.timezone', $setting->time_zone);
        }
        //share variable in all views
        View::composer('*', function ($view) use ($setting) {
            $view->with('setting', $setting);
        });
    }
}
