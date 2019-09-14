<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RulesCategory extends Model
{
    public function server()
    {
        return $this->belongsTo('App\Server');
    }

    public function rules()
    {
        return $this->hasMany('App\RulesItems');
    }
}
