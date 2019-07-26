<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Syntax\SteamApi\Facades\SteamApi;
use Invisnik\LaravelSteamAuth\SteamAuth;
use App\User;
use Auth;

class MainController extends Controller
{
    public function index(Request $request) {

//        $steamid = 'STEAM_0:0:24528556';
//        dd(SteamApi::user($steamid)->GetPlayerSummaries()[0]);

        return view('index');


    }
}
