<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function server()
    {
        return $this->belongsTo('App\Server');
    }

    public function sendByUser()
    {
        return $this->belongsTo('App\User', 'sender_id', 'id');
    }

    public function perpetrateByUser()
    {
        return $this->belongsTo('App\User', 'perpetrator_id', 'id');
    }
}
