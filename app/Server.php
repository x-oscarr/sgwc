<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    public $timestamps = false;

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public function rules()
    {
        return $this->hasMany('App\RulesCategory');
    }
}
