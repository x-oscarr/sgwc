<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public const STATUS_NEW = 1;
    public const STATUS_ACCEPTED = 2;
    public const STATUS_DENIED = 3;

    public const TYPE_PLAYER_REPORT = 'player_report';
    public const TYPE_ADMIN_REPORT = 'admin_report';
    public const TYPE_BUG_REPORT = 'bug_report';
    public const TYPE_TECH_REPORT = 'tech_report';

    public function server()
    {
        return $this->belongsTo('App\Server', 'server_id', 'id');
    }

    public function sendByUser()
    {
        return $this->belongsTo('App\User', 'sender_id', 'id');
    }

    public function perpetrateByUser()
    {
        return $this->belongsTo('App\User', 'perpetrator_id', 'id');
    }

    public function rule()
    {
        return $this->belongsTo('App\RulesItem', 'rule_id', 'id');
    }

    public function dispute()
    {
        return $this->hasOne('App\ReportDispute');
    }
}
