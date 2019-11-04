<?php

namespace App\Http\Controllers;

use App\Helpers\PMLoader;
use App\SiteModule;
use Auth;
use App\Helpers\Monitoring;
use App\Server;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Syntax\SteamApi\Facades\SteamApi;
use Invisnik\LaravelSteamAuth\SteamAuth;

class MainController extends Controller
{
    public function index(Request $request, Monitoring $monitoring) {

        $serverlist = Server::where('monitoring', 1)->get();

        foreach ($serverlist as $server) {
            $monitoringServers[] = [
                'id' => $server->id,
                'name' => $server->name,
                'ip' => $server->ip,
                'port' => $server->port
            ] + $monitoring->Online($server->ip, $server->port);
        }

        //dd($monitoringServers);

        return view('index', [
            'monitoringServers' => $monitoringServers ?? null
        ]);
    }

    public function dev() {
        return view('dev', [

        ]);
    }
}
