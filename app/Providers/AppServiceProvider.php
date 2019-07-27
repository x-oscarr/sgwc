<?php

namespace App\Providers;

use App\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {
            $settings_data = Setting::all();
            foreach ($settings_data as $setting) {
                $settings[$setting['parameter']] = $setting['value'];
            }
            $view->with(['settings' => $settings]);
        });
    }
}
