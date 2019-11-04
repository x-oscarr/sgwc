<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MenuItem extends Model
{
    public const ITEM_TYPE_MAIN = 1;
    public const ITEM_TYPE_ADMIN = 2;

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

        // find active items
        foreach ($menuItems as $menuItem) {
            if ($menuItem->siteModule) {
                if($menuItem->parent && $menuItem->parent->siteModule->is_enabled) $activeItems[] = $menuItem;
                elseif($menuItem->siteModule->is_enabled) $activeItems[] = $menuItem;
            }
            else {
                $activeItems[] = $menuItem;
            }
        }
        // structure
        foreach ($activeItems as $menuItem) {
            $access = false;
            if (!$menuItem->parent) {
                switch ($menuItem->access) {
                    case 'auth':
                        if(Auth::check() == $menuItem->access_params ?? true) $access = true;
                        break;
                    case 'role':
                        if(Auth::check() && Auth::user()->hasRole($menuItem->access_params)) $access = true;
                        break;
                    case 'permission':
                        if(Auth::check() && Auth::user()->canDo($menuItem->access_params)) $access = true;
                        break;
                    case null:
                        $access = true;
                        break;
                }
                if($access) {
                    $displayItems[] = $menuItem;
                }
                else {
                    if($menuItem->child) $displayItems[] = $menuItem->child;
                }
            }
        }
        // sort items
        foreach ($displayItems as $menuItem) {
            if ($menuItem->type == MenuItem::ITEM_TYPE_MAIN) {
                $result[MenuItem::ITEM_TYPE_MAIN][] = $menuItem;
            }
            elseif ($menuItem->type == MenuItem::ITEM_TYPE_ADMIN) {
                $result[MenuItem::ITEM_TYPE_ADMIN][] = $menuItem;
            }
        }

        if (isset($result[MenuItem::ITEM_TYPE_MAIN])) {
            usort($result[MenuItem::ITEM_TYPE_MAIN], function($a, $b) {
                return $a->position <=> $b->position;
            });
        }

        if(isset($result[MenuItem::ITEM_TYPE_ADMIN])) {
            usort($result[MenuItem::ITEM_TYPE_ADMIN], function($a, $b) {
                return $a->position <=> $b->position;
            });
        }

        return $result ?? null;
    }
}
