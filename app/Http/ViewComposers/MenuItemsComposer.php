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
        $view->with('menuItemsList', $this->findKeyWords(MenuItem::activeItems()));
    }

    private function findKeyWords($menuItemsData)
    {
        if(!$menuItemsData) return null;

        $keyWords = [
            '&UID&' => $this->auth::check() ? $this->auth::user()->id : '???',
            '&USERNAME&' => $this->auth::check() ? $this->auth::user()->username : 'Anonymous'
        ];

        foreach ($menuItemsData as $key => $menuItems) {
            foreach ($menuItems as $menuItem) {
                $menuItem->text = strtr($menuItem->text, $keyWords);
                $result[$key][] = $menuItem;
            }
        }
        return $result ?? [];
    }
}
