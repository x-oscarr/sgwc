<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Illuminate\Http\Request;
use Syntax\SteamApi\Facades\SteamApi;

class UserController extends Controller
{
    public function index() {
        if(!Auth::check()) {
            return redirect()->route('auth');
        }

        return view('profile');
    }

    public function single($id) {
        $user = App\User::find($id);
        if (!is_null($user)) {
            dd($user);
        }
        else {
            return view('errors.404');
        }
    }

    public function steamid($steamid) {
        if (empty(SteamApi::user($steamid)->GetPlayerSummaries())) {
            return view('errors.404');
        }

        $user['info'] = SteamApi::user($steamid)->GetPlayerSummaries()[0];
        $user['bans'] = SteamApi::user($steamid)->GetPlayerBans()[0];
        return view('steamid', [
            'user' => $user ?? null
        ]);
    }

}
