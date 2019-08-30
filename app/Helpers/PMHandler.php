<?php


namespace App\Helpers;


use Illuminate\Support\Facades\DB;

class PMHandler
{
    static public function load($request, $steamid)
    {
//        $request = app(\Illuminate\Http\Request::class);
        $plugin_modules_data = DB::table('plugin_modules')
            ->where(['is_enabled' => true, 'server_id' => $request->get('server') ?? env('DEFAULT_SERVER', 1)])
            ->get();

        foreach ($plugin_modules_data as $module) {
            $plugin_user_data[$module->plugin] = PMLoader::getData($module, $steamid)->getUserData();
            $plugin_params[$module->plugin] = PMLoader::getParams($module);
            $plugin_objects[$module->plugin] = $module;
        }

        // Custom autoload data
//        $plugin_custom_data = [
//            'test' => isset($plugin_objects['shop']) ? PMLoader::getData($plugin_objects['shop'], $steamid)->test() : null,
//        ];

        return [
            'user_data'=> $plugin_user_data ?? null,
            'custom_data' => $plugin_custom_data ?? null,
            'params' => $plugin_params ?? null
        ];
    }
}
