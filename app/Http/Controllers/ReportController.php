<?php

namespace App\Http\Controllers;

use App\Reports;
use App\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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

    public function add(Request $request)
    {
        if(!empty($request->all())) {
            $validatedData = $request->validate([
                'sender'  => 'required|max:50',
                'perpetrator' => '',
                'date' => 'required',
                'time' => 'required',
                'info' => 'required|min:30|max:600',
                'image' => 'image'
            ]);
            dd($validatedData);
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
