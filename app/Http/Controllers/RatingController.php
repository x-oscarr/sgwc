<?php

namespace App\Http\Controllers;


use App\Helpers\PMLoader;
use App\PluginModule;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function index(Request $request)
    {
        $pm = $request->get('pm') ?? 'shop';
        $limit = $request->get('limit') ?? 50;
        $plugin_modules_list = DB::table('plugin_modules')->where('is_enabled', true)->get();

        foreach ($plugin_modules_list as $plugin_module) {
            $plugin_loader = PMLoader::getData($plugin_module, Auth::user()->steamid);
            if(method_exists($plugin_loader, 'getTopUserData')) {
                $plugin_modules[$plugin_module->plugin] = $plugin_loader;
                $plugin_modules_names[] = [
                    'name' => $plugin_module->name,
                    'plugin' => $plugin_module->plugin
                ];
            }
        }

        if (array_key_exists($pm, $plugin_modules)) {
            $plugin_module = $plugin_modules[$pm];
            $rating_full_data = $plugin_module->getTopUserData($request->get('order_by') ?? $plugin_module->pluginObject->table_players['order_by']);
            $rating_columns = array_keys((array) $rating_full_data[0] ?? []);
            $user_data_key = array_search($plugin_module->steamid, array_column($rating_full_data, $plugin_module->pluginObject->table_players['col']));

            if($user_data_key) {
                $user_data = $rating_full_data[$user_data_key];
            }

            $rating_data = array_slice($rating_full_data, 0 , $limit <= 200 ? $limit : 200);
        }
        else {
            return view('errors.404');
        }

        return view('rating.list', [
            'plugin_modules_names' => $plugin_modules_names,
            'rating_data' => $rating_data ?? null,
            'user_data' => $user_data ?? null,
            'rating_columns' => $rating_columns
        ]);
    }
}
