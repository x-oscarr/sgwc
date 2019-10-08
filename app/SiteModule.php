<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteModule extends Model
{
    public function menuItems()
    {
        $menu_items = $this->hasMany('App\MenuItem');
        dd($menu_items);
        return $menu_items;
//        for ($i=0; $i < count($menu_items); $i++) {
//            $element[$i]['main'] = $menu_items[$i];
//            if($menu_items[$i]->child()) {
//                $element[$i]['alt'] = $menu_items[$i]->child();
//            }
//        }
    }
}
