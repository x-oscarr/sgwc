<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PluginModule extends Model
{
    public function server()
    {
        return $this->hasMany('App\Server', 'id');
    }
}
