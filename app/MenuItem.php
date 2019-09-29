<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    public function siteModule()
    {
        return $this->belongsTo('App\SiteModule');

    }

    public function child()
    {
        return $this->belongsTo('App\MenuItem');
    }
}
