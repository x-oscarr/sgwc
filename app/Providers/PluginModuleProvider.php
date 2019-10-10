<?php

namespace App\Providers;

use App\Helpers\PMHandler;
use App\Server;
use Auth;
use App\Helpers\PMLoader;
use App\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class PluginModuleProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('*', function($view) {
            $request = app(\Illuminate\Http\Request::class);

            $settings_data = Setting::all();
            $settings = null;
            foreach ($settings_data as $setting) {
                $settings[$setting['parameter']] = $setting['value'];
            }

            $servers = Server::where('display', true)->get();
            $servers_arr = [];
            foreach ($servers as $server) {
                $servers_arr[$server->id] = $server->name;
            }
            $view->with([
                'settings' => $settings,
                'servers_list' => $servers,
                'servers_arr' => $servers_arr,
                'selected_server' => $request->get('server') ?? env('DEFAULT_SERVER', 1)
            ]);
        });

        View::composer(['profile'], function($view) {
            if(Auth::user()) {
                $request = app(\Illuminate\Http\Request::class);
                $PMData = PMHandler::load($request, Auth::user()->steam32);
                $view->with([
                    'plugin_user_data'=> $PMData['user_data'],
                    'plugin_custom_data' => $PMData['custom_data'],
                    'plugin_params' => $PMData['params'],
                ]);
            }
        });
    }
}
