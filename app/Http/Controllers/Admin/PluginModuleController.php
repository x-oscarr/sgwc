<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\PMLoader;
use App\PluginModule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PluginModuleController extends Controller
{
    public function settings($id) {
        $pluginModule = PluginModule::findOrFail($id);


        $action = PMLoader::getParams($pluginModule)['settings_action'];


        return redirect()->action(PMLoader::getParams($pluginModule)['settings_action']);

    }
}
