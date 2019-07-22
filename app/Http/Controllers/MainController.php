<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Syntax\SteamApi\Facades\SteamApi;

class MainController extends Controller
{
    public function index() {

        $steamid = 'STEAM_0:0:24528556';
        dd(SteamApi::user($steamid)->GetPlayerSummaries()[0]);
    }
}
