<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {


        return view('admin.settings.index', [

        ]);
    }

    public function servers()
    {


        return view('admin.settings.servers', [

        ]);
    }

    public function design()
    {


        return view('admin.settings.design', [

        ]);
    }

    public function web()
    {


        return view('admin.settings.web', [

        ]);
    }

    public function permissions()
    {


        return view('admin.settings.permissions', [

        ]);
    }
}
