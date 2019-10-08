<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    public function siteModule()
    {
        return $this->belongsTo('App\SiteModule');

    }

    public function parent()
    {
        return $this->belongsTo('App\MenuItem', 'parent_id', 'id');
    }

    public function child()
    {
        return $this->belongsTo('App\MenuItem', 'id', 'parent_id');
    }

    public  function activeItems() {
        static::all();
    }
}
