<?php

namespace App\Http\Controllers;

use Auth;
use App\Helpers\Monitoring;
use App\Server;
use App\User;
use Illuminate\Http\Request;
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
            'servers' => $servers
        ]);
    }
}
