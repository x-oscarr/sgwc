<?php

namespace App\Providers;

use App\Helpers\PMHandler;
use Auth;
use App\Helpers\PMLoader;
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

        View::composer(['profile'], function($view) {
            if(Auth::user()) {
                $request = app(\Illuminate\Http\Request::class);
                $PMData = PMHandler::load($request, Auth::user()->steam32);
            }

            $view->with([
                'plugin_user_data'=> $PMData['user_data'],
                'plugin_custom_data' => $PMData['custom_data'],
                'plugin_params' => $PMData['params'],
            ]);
        });
    }

}
