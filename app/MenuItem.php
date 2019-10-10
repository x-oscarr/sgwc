<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    public $timestamps = false;

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

    static public function activeItems() {
        $menuItems = static::all();
        foreach ($menuItems as $menuItem) {
            if ($menuItem->siteModule) {
                if($menuItem->parent && $menuItem->parent->siteModule->is_enabled) $activeItems[] = $menuItem;
                elseif($menuItem->siteModule->is_enabled) $activeItems[] = $menuItem;
            }
            else {
                $activeItems[] = $menuItem;
            }
        }
//        sort($activeItems, function($a, $b) {
//            return $a['position'] <=> $b['position'];
//        });
        return $activeItems ?? null;
    }
}
