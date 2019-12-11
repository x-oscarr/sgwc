<?php

namespace App\Http\Controllers;

use App\Helpers\PMLoader;
use App\Helpers\VDF;
use App\ShopItem;
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
        return view('index', [
            'monitoringServers' => $monitoringServers ?? null,
            'monitoringServersJson' => json_encode($monitoringServers)
        ]);
    }

    public function dev() {
        dd(ShopItem::getByUser(3));

        return view('dev', [

        ]);
    }

    public function monitoring(Monitoring $monitoring)
    {
        $serverList = Server::where('monitoring', 1)->get();

        foreach ($serverList as $server) {
            $monitoringServers[] = [
                    'id' => $server->id,
                    'name' => $server->name,
                    'ip' => $server->ip,
                    'port' => $server->port
            ] + $monitoring->Online($server->ip, $server->port);
        }

        return \response(['status' => true, 'monitoringServers' => $monitoringServers ?? null], 200);
    }
}
