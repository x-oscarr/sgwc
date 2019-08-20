<?php

namespace App\Http\Controllers;

use App;
use App\Helpers\PMHandler;
use Auth;
use Illuminate\Http\Request;
use Syntax\SteamApi\Facades\SteamApi;

class UserController extends Controller
{
    public function index(Request $request) {
        if(!Auth::check()) {
            return redirect()->route('auth');
        }

        $servers = App\Server::where('display', true)->get();

        return view('profile', [
            'servers' => $servers,
            'selected_server' => $request->get('server') ?? env('DEFAULT_SERVER', 1)
        ]);
    }

    public function single($id, Request $request) {
        $user = App\User::find($id)->first();
        if (!is_null($user)) {
            $PMData = PMHandler::load($request, $user->steamid);
            $servers = App\Server::where('display', true)->get();

            return view('user', [
                'user' => $user ?? null,
                'plugin_user_data'=> $PMData['user_data'],
                'plugin_custom_data' => $PMData['custom_data'],
                'plugin_params' => $PMData['params'],
                'servers' => $servers,
                'selected_server' => $request->get('server') ?? env('DEFAULT_SERVER', 1)
            ]);
        }
        else {
            return view('errors.404');
        }
    }

    public function list()
    {
        $user = App\User::all()->sortByDesc();
    }

    public function steamid(Request $request, $steamid) {
        if (empty(SteamApi::user($steamid)->GetPlayerSummaries())) {
            return view('errors.404');
        }

        $user['info'] = SteamApi::user($steamid)->GetPlayerSummaries()[0];
        $user['bans'] = SteamApi::user($steamid)->GetPlayerBans()[0];
        $user['profile'] = App\User::where('steamid', SteamApi::convertId($steamid, 'ID64'))->first();
        $PMData = PMHandler::load($request, $steamid);

        $servers = App\Server::where('display', true)->get();

        return view('steamid', [
            'user' => $user ?? null,
            'plugin_user_data'=> $PMData['user_data'],
            'plugin_custom_data' => $PMData['custom_data'],
            'plugin_params' => $PMData['params'],
            'servers' => $servers,
            'selected_server' => $request->get('server') ?? env('DEFAULT_SERVER', 1)
        ]);
    }

}
