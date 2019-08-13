<?php

namespace App\Http\Controllers;

use App\Helpers\PMLoader;
use Auth;
use App\Helpers\Monitoring;
use App\Server;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Syntax\SteamApi\Facades\SteamApi;
use Invisnik\LaravelSteamAuth\SteamAuth;

class MainController extends Controller
{
    public function index(Request $request, Monitoring $monitoring) {

        $serverlist = Server::where('display', 1)->get();

        for($i = 0; $i < count($serverlist); $i++) {
            $server_data = $monitoring->Online($serverlist[$i]['ip'], $serverlist[$i]['port']);
            $servers[$i]['id'] = $serverlist[$i]['id'];
            $servers[$i]['name'] = $serverlist[$i]['name'];
            $servers[$i]['ip'] = $serverlist[$i]['ip'];
            $servers[$i]['port'] = $serverlist[$i]['port'];
            $servers[$i] += $server_data;
        }

        return view('index', [
            'servers' => $servers ?? null
        ]);
    }

    public function dev() {

        $plugin = DB::table('plugin_modules')->find(1);
//        $plugin2 = DB::table('plugin_modules')->find(3);
//        $plugin3 = DB::table('plugin_modules')->find(4);
//        $plugin4 = DB::table('plugin_modules')->find(2);
////        $PMLoader = new PMLoader();

       dump(PMLoader::getData($plugin, 'STEAM_1:0:72120179'));
//        dump(PMLoader::getData($plugin3, 'STEAM_1:0:72120179')->getUserData());
//        dump(PMLoader::getData($plugin4, '144240358')->getUserData());

    }
}
