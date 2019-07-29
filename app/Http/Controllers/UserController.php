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
}
