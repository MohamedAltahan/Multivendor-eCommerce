<?php

namespace App\Providers;

use App\Models\EmailConfiguration;
use App\Models\LogoSetting;
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
        $logoSetting = LogoSetting::first();
        $mailSetting = EmailConfiguration::first();
        //set mail configuration (it will overwrite .env or default setting)
        config::set('mail.mailers.smtp.host', $mailSetting->host);
        config::set('mail.mailers.smtp.port', $mailSetting->port);
        config::set('mail.mailers.smtp.encryption', $mailSetting->encryption);
        config::set('mail.mailers.smtp.username', $mailSetting->username);
        config::set('mail.mailers.smtp.password', $mailSetting->password);

        if (isset($setting)) {
            Config::set('app.timezone', $setting->time_zone);
        }
        //share variable in all views
        View::composer('*', function ($view) use ($setting, $logoSetting) {
            $view->with(['setting' => $setting, 'logoSetting' => $logoSetting]);
        });
    }
}
