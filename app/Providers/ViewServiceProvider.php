<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', 'App\Http\ViewComposers\ServersComposer');
        View::composer('*', 'App\Http\ViewComposers\SettingsComposer');
        View::composer('builder.menu', 'App\Http\ViewComposers\MenuItemsComposer');
        View::composer('admin.settings.index', 'App\Http\ViewComposers\MenuItemsComposer');
    }
}
