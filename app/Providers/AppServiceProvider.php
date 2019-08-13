<?php

namespace App\Providers;

use Auth;
use App\Helpers\PMLoader;
use App\PluginModule;
use App\Setting;
use Illuminate\Support\Facades\DB;
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
            if(Auth::user()) {
                $plugin_modules_data = DB::table('plugin_modules')->where(['is_enabled' => true])->get();
                $plugin_modules = null;
                foreach ($plugin_modules_data as $module) {
                    $plugin_modules[$module->plugin] = PMLoader::getData($module, 'STEAM_1:0:72120179')->getUserData();
                }
            }
            $view->with(['plugin_modules' => $plugin_modules ?? null]);
        });
    }
}
