<?php

namespace App\Http\Controllers;

use App\Reports;
use Illuminate\Http\Request;
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

    public function add()
    {

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
