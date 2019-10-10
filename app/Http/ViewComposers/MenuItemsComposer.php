<?php

namespace App\Http\ViewComposers;

use App\MenuItem;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class MenuItemsComposer
{
    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function compose(View $view)
    {
        dd($this->menuItemBuilder(MenuItem::activeItems()));
        $view->with('menuItems', $this->menuItemBuilder(MenuItem::activeItems()));
    }

    private function findKeyWords($menuItems)
    {
        if(!$menuItems) return null;

        $keyWords = [
            '&USERNAME&' => $this->auth::check() ? $this->auth::user()->username : 'Anonymous'
        ];

        foreach ($menuItems as $menuItem) {
            $menuItem->text = strtr($menuItem->text, $keyWords);
            $result[] = $menuItem;
        }
        return $result ?? [];
    }

    private function menuItemBuilder($menuItems) {
        $menuItems = $this->findKeyWords($menuItems);
        foreach ($menuItems as $menuItem) {
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
                    $result[] = $menuItem;
                }
                else {
                    if($menuItem->child) $result[] = $menuItem->child;
                }
            }
        }
        return $result ?? [];
    }
}
