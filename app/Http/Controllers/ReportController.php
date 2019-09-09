<?php

namespace App\Http\Controllers;

use App\Report;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Syntax\SteamApi\Facades\SteamApi;
use function MongoDB\BSON\toJSON;

class ReportController extends Controller
{
    public function index(Request $request)
    {
//        $reports = Report::all();

        if ($request->all()) {
            //dd($request->all());
            $qb = [];
            $request->get('id') ? $qb[] = "where('id', ".$request->get('id').")" : null;
            $request->get('server') ? $qb[] = "where('server', ".$request->get('server').")" : null;
            $request->get('type') ? $qb[] = "where('type', '".$request->get('type')."')" : null;
            $qb = '$result = Report::'.implode( '->',$qb);
//            eval($qb);
//            dd($result);

        }
        else {
            $reports = Report::all();
        }


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
                $valid_data = $validator->valid();

                $report = new Report();
                $report->server_id = $valid_data['server'];
                $report->type = $valid_data['type'];
                $report->description = $valid_data['info'];
                if (isSteamId($valid_data['sender'])) {
                    $report->sender = SteamApi::convertId($valid_data['sender'], 'ID32');
                    $report->sender_id = User::where('steam32', $report->sender)->select('id')->value('id');
                }
                else $report->sender = $valid_data['sender'];
                if (isSteamId($valid_data['perpetrator'])) {
                    $report->perpetrator = SteamApi::convertId($valid_data['perpetrator'], 'ID32');
                    $report->perpetrator_id = User::where('steam32', $report->perpetrator)->select('id')->value('id');
                }
                else $report->perpetrator = $valid_data['perpetrator'];
                $report->is_anon = $valid_data['anonymously'] ?? false;
                $report->time = Carbon::parse($valid_data['date'].' '.$valid_data['time'])->toDateTimeString();
                if($request->hasFile('image')) {
                    $path = $request->file('image')->store('report', 'public');
                    $report->file = Storage::url($path);
                }
                if($report->save()) {
                    return redirect()->route('report.single', ['id' => $report->id]);
                }

            }
        }

        return view('report/add', [

        ]);
    }

    public function single($id)
    {
        $report = Report::findOrFail($id);
        $server = $report->server;

        if(isSteamId($report->sender)) {
            $sender = SteamApi::user($report->sender)->GetPlayerSummaries()[0]->personaName;
            $sender_url = route('steamid', $report->sender);
        }
        else $sender = $report->sender;

        if(isSteamId($report->perpetrator)) {
            $perpetrator = SteamApi::user($report->perpetrator)->GetPlayerSummaries()[0]->personaName;
            $perpetrator_url = route('steamid', $report->perpetrator);
        }
        else $perpetrator = $report->perpetrator;

        return view('report/single', [
            'report' => $report,
            'server' => $server,
            'sender' => $sender,
            'perpetrator' => $perpetrator,
            'sender_url' => $sender_url ?? null,
            'perpetrator_url' => $perpetrator_url ?? null
        ]);
    }

    public function sort(Request $request)
    {
        if ($request->ajax()) {
            $reports = [];
            if($request->get('id')) {
                $reports[] = Report::find($request->get('id'));
            }
            if($request->get('server')) {
                $reports[] = Report::where('server', $request->get('server'));
            }
            if($request->get('type')) {
                $reports[] = Report::where('type', $request->get('type'));
            }
//            if($request->get('user')) {
//
//            }
//            if($request->get('date')) {
//
//            }
            return json_encode($reports);
        }
        else {
            dd($request->attributes);
        }

    }
}
