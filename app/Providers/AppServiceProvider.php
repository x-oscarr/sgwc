<?php

namespace App\Providers;

use App\PluginModule;
use App\Setting;
use App\SiteModule;
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
            $settings = null;
            foreach ($settings_data as $setting) {
                $settings[$setting['parameter']] = $setting['value'];
            }
            $view->with(['settings' => $settings]);
        });

        View::composer(['profile', 'user'], function($view) {
            $plugin_modules_data = PluginModule::all();
            $plugin_modules = null;
            foreach ($plugin_modules_data as $module) {
                $plugin_modules[$module['name']] = $module;
            }
            $view->with(['plugin_modules' => $plugin_modules]);
        });
    }
}
