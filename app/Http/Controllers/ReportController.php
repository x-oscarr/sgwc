<?php

namespace App\Http\Controllers;

use App\Reports;
use App\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Syntax\SteamApi\Facades\SteamApi;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Reports::all();
        return view('report/list', [
            'reports' => $reports
        ]);
    }

    public function add(Request $request, File $file)
    {
        if($request->all()) {
            $validator = Validator::make(Input::all(), [
                'sender'  => 'required|max:50',
                'perpetrator' => 'max:50'.($request->get('type') == 'player_report' || $request->get('type') == 'admin_report' ? '|required' : ''),
                'date' => 'required',
                'time' => 'required',
                'info' => 'required|min:30|max:600',
                'image' => 'image|max:2048'
            ]);
            $validator->validate();

            if(!$validator->fails()) {
                if($request->hasFile('image')) {
                    $path = $request->file('image')->store('reports', 'public');
                    dd(Storage::url($path));
                }
            }
        }

        return view('report/add', [

        ]);
    }

    public function single($id)
    {
        $report = Reports::find($id);
        $server = $report->server[0];
        $sender = SteamApi::user($report->sender)->GetPlayerSummaries()[0]->personaName;
        $perpetrator = SteamApi::user($report->perpetrator)->GetPlayerSummaries()[0]->personaName;
        return view('report/single', [
            'report' => $report,
            'server' => $server,
            'sender' => $sender,
            'perpetrator' => $perpetrator
        ]);
    }
}
