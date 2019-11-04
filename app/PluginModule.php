<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PluginModule extends Model
{
    public $timestamps = false;

    public function server()
    {
        return $this->belongsTo('App\Server', 'server_id', 'id');
    }
}
