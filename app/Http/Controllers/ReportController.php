<?php

namespace App\Http\Controllers;

use App\Report;
use App\RulesCategory;
use App\SiteModule;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Syntax\SteamApi\Facades\SteamApi;

class ReportController extends Controller
{
    public function index(Request $request)
    {
//        $reports = Report::all();

        if ($request->all()) {
            $qb = Report::where(null);
            if($request->get('id')) {
                $qb->where('id', $request->get('id'));
            }
            else {
                $request->get('type') ? $qb->where('type', $request->get('type')) : null;
                $request->get('server') ?  $qb->where('server_id', $request->get('server')) : null;
                if($request->get('date')) {
                    $date = Carbon::parse($request->get('date'))->format('Y-m-d');
                    $qb->whereDate('time', $date)
                        ->orWhereDate('created_at', $date);
                }
                if($request->get('user')) {
                    $user = $request->get('user');
                    $qb->where('sender_name', 'like','%'.$user.'%')
                        ->orWhere('sender_auth', $user)
                        ->orWhere('perpetrator_name', 'like', '%'.$user.'%')
                        ->orWhere('perpetrator_auth', $user);
                }
                if ($request->get('order')) {
                    $order_by = explode('.', $request->get('order'));
                    $qb->orderBy($order_by[0], $order_by[1]);
                }
                else $qb->orderBy('id', 'desc');
            }
            $reports = $qb->get();
        }
        else {
            $reports = Report::all();
        }


        return view('report/list', [
            'reports' => $reports,
        ]);
    }

    public function add(Request $request, File $file)
    {
        $rulesModule = SiteModule::where('slug', 'rules_list')->where('is_enabled', true)->first();
        if($rulesModule) {
            $rulesData = RulesCategory::where('is_report_selectable', true)->where('parent_id', '!=', null)->get();
            foreach ($rulesData as $rulesCategory) {
                foreach ($rulesCategory->rules as $rulesItem)
                $rulesOption[$rulesCategory->title][$rulesItem->id] = $rulesItem->text;
            }
        }

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

                // Sender authentication
                if (isSteamId($valid_data['sender'])) {
                    $report->sender_auth = SteamApi::convertId($valid_data['sender'], 'ID32');
                    $report->sender_name = SteamApi::user($report->sender_auth)->GetPlayerSummaries()[0]->personaName;
                    $report->sender_id = User::where('steam32', $report->sender_auth)->select('id')->value('id');
                }
                else {
                    $report->sender_name = $valid_data['sender'];
                }

                // Perpetrator authentication
                if (isSteamId($valid_data['perpetrator'])) {
                    $report->perpetrator_auth = SteamApi::convertId($valid_data['perpetrator'], 'ID32');
                    $report->perpetrator_name = SteamApi::user($report->perpetrator_auth)->GetPlayerSummaries()[0]->personaName;
                    $report->perpetrator_id = User::where('steam32', $report->perpetrator_auth)->select('id')->value('id');
                }
                else {
                    $report->perpetrator_name = $valid_data['perpetrator'];
                }

                $report->is_anon = $valid_data['anonymously'] ?? false;
                $report->time = Carbon::parse($valid_data['date'].' '.$valid_data['time'])->toDateTimeString();
                $report->rule_id = $valid_data['rule'];
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
            'rules_module' => $rulesModule,
            'rules_option' => $rulesOption ?? null
        ]);
    }

    public function single($id)
    {
        $report = Report::findOrFail($id);
        $server = $report->server;

        if ($report->is_anon) {
            $sender = '<i class="fas fa-eye-slash"></i> Anonymously';
        }
        else {
            $sender = $report->sender_name;
            isSteamId($report->sender_auth) ? $sender_url = route('steamid', $report->sender_auth) : null;
        }

        $perpetrator = $report->perpetrator_name;
        isSteamId($report->perpetrator_auth) ? $perpetrator_url = route('steamid', $report->perpetrator_auth) : null;

        return view('report/single', [
            'report' => $report,
            'server' => $server,
            'sender' => $sender,
            'perpetrator' => $perpetrator,
            'sender_url' => $sender_url ?? null,
            'perpetrator_url' => $perpetrator_url ?? null
        ]);
    }

    public function myReports()
    {
        $user = Auth::user();
        dd($user->sendByUser);
    }

    public function myViolations()
    {
        $user = Auth::user();
        dd($user->perpetrateByUser);
    }
}
