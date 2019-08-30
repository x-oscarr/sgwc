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
        $plugin_module = DB::table('plugin_modules')
            ->where('is_enabled', true)
            ->where('plugin', $request->get('pm') ?? 'shop')
            ->first();

        if(is_null($plugin_module)) {
            return view('errors.404');
        }

        $plugin_loader = PMLoader::getData($plugin_module, Auth::user()->steamid);
        if(method_exists($plugin_loader, 'getTopUserData')) {
           $rating_data[$plugin_module->plugin] = $plugin_loader->getTopUserData($request->get('order_by') ?? $plugin_loader->pluginObject->table_players['order_by']);
           $rating_array = (array) $rating_data[$plugin_module->plugin];
           $user_data_key = array_search($plugin_loader->steamid, array_column(reset($rating_array), $plugin_loader->pluginObject->table_players['col']));
           if($user_data_key) {
               $user_data[$plugin_module->plugin] = $rating_data[$plugin_module->plugin][$user_data_key];
           }
        }
        dd($user_data);
       return view('rating.list', [
           'rating_data' => $rating_data ?? null,
           'user_data' => $user_data ?? null
       ]);
    }
}
