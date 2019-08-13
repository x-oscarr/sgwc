<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    public function server()
    {
        return $this->hasMany('App\Server', 'id');
    }
}
