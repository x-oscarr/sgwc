<?php

use Illuminate\Database\Seeder;

class DefaultMenuItemSeeder extends Seeder
{
    protected $menuItems = [
        [
            'text' => '<i class="fas fa-user"></i> &USERNAME&',
            'route' => 'profile',
            'route_params' => null,
            'access' => 'auth',
            'access_params' => true,
            'position' => 1,
            'type' => 'main',
            'child' => [
                'text' => '<i class="fas fa-user"></i> Профиль',
                'route' => 'auth',
                'route_params' => null,
                'access' => null,
                'access_params' => null,
                'position' => 1,
                'type' => 'main',
            ]
        ],
        [
            'text' => '<i class="fas fa-laptop-code"></i> Админпанель',
            'route' => 'profile',
            'route_params' => null,
            'access' => 'permission',
            'access_params' => 'page.admin.panel',
            'position' => 1,
            'type' => 'adminpanel',
            'child' => null
        ],
        [
            'text' => '<i class="fas fa-cogs"></i> Настройки',
            'route' => 'profile',
            'route_params' => null,
            'access' => 'permission',
            'access_params' => 'page.settings',
            'position' => 2,
            'type' => 'adminpanel',
            'child' => null
        ],
        [
            'text' => '<i class="fas fa-tools"></i> Инструменты',
            'route' => 'profile',
            'route_params' => null,
            'access' => 'permission',
            'access_params' => 'page.tools',
            'position' => 3,
            'type' => 'adminpanel',
            'child' => null
        ],

    ];

    public function run()
    {
        foreach ($this->menuItems as $menuElement) {
            $menuItem = new \App\MenuItem();
            $menuItem->site_module_id = null;
            $menuItem->text = $menuElement['text'];
            $menuItem->route = $menuElement['route'];
            $menuItem->route_params = $menuElement['route_params'];
            $menuItem->access = $menuElement['access'];
            $menuItem->access_params = $menuElement['access_params'];
            $menuItem->parent_id = null;
            $menuItem->position = $menuElement['position'];
            $menuItem->type = $menuElement['type'];
            $menuItem->save();

            if ($menuElement['child']) {
                $childMenuItem = new \App\MenuItem();
                $childMenuItem->text = $menuElement['child']['text'];
                $childMenuItem->route = $menuElement['child']['route'];
                $childMenuItem->route_params = $menuElement['child']['route_params'];
                $childMenuItem->access = $menuElement['child']['access'];
                $childMenuItem->access_params = $menuElement['child']['access_params'];
                $childMenuItem->parent_id = $menuItem->id;
                $childMenuItem->position = $menuElement['child']['position'];
                $childMenuItem->type = $menuElement['child']['type'];
                $childMenuItem->save();
            }
        }
    }
}
