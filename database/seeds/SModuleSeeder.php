<?php

use Illuminate\Database\Seeder;

class SModuleSeeder extends Seeder
{
    protected $module = [
        [
            'name' => 'Report System',
            'description' => 'Reporting system that allows you to create reports',
            'version' => '1.0',
            'slug' => 'report_system',
            'is_enabled' => true,
            'menu_items' => [
                [
                    'text' => '<i class="fas fa-flag"></i> Подать жалобу',
                    'route' => 'report.add',
                    'route_params' => null,
                    'access' => null,
                    'access_params' => null,
                    'child' => null,
                    'position' => 4,
                    'type' => \App\MenuItem::ITEM_TYPE_MAIN
                ],
                [
                    'text' => '<i class="fas fa-angry"></i> Репорты',
                    'route' => 'dev',
                    'route_params' => null,
                    'access' => 'permission',
                    'access_params' => 'page.reports.panel',
                    'child' => null,
                    'position' => 4,
                    'type' => \App\MenuItem::ITEM_TYPE_ADMIN
                ]
            ]
        ],
        [
            'name' => 'Rules List',
            'description' => 'Game project rules list',
            'version' => '1.0',
            'slug' => 'rules_list',
            'is_enabled' => true,
            'menu_items' => [
                [
                    'text' => '<i class="fas fa-book"></i> Правила',
                    'route' => 'rules.list',
                    'route_params' => null,
                    'access' => null,
                    'access_params' => null,
                    'child' => null,
                    'position' => 3,
                    'type' => \App\MenuItem::ITEM_TYPE_MAIN
                ],
            ]
        ],
        [
            'name' => 'Players Rating',
            'description' => 'Rating of players on game servers',
            'version' => '1.0',
            'slug' => 'players_rating',
            'is_enabled' => true,
            'menu_items' => [
                [
                    'text' => '<i class="fas fa-chart-line"></i> Рейтинг',
                    'route' => 'rating',
                    'route_params' => null,
                    'access' => null,
                    'access_params' => null,
                    'child' => null,
                    'position' => 2,
                    'type' => \App\MenuItem::ITEM_TYPE_MAIN
                ],
            ]
        ]
    ];

    public function run()
    {
        foreach ($this->module as $module) {
            $siteModule = new \App\SiteModule();
            $siteModule->name = $module['name'];
            $siteModule->description = $module['description'];
            $siteModule->version = $module['version'];
            $siteModule->slug = $module['slug'];
            $siteModule->is_enabled = $module['is_enabled'];
            $siteModule->save();

            foreach ($module['menu_items'] as $menuElement) {
                $menuItem = new \App\MenuItem();
                $menuItem->site_module_id = $siteModule->id;
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
}
