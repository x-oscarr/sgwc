<?php

namespace App\Http\ViewComposers;

use App\Server;
use App\Setting;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ServersComposer
{
    public function compose(View $view)
    {
        $request = app(Request::class);

        $servers = Server::where('display', true)->get();
        $servers_arr = [];
        foreach ($servers as $server) {
            $servers_arr[$server->id] = $server->name;
        }
        $view->with([
            'servers_list' => $servers,
            'servers_arr' => $servers_arr,
            'selected_server' => $request->get('server') ?? env('DEFAULT_SERVER', 1)
        ]);
    }
}
