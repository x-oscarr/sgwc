<?php

use Illuminate\Database\Seeder;

class PModuleSeeder extends Seeder
{
    protected $plugins = [
        [
            'name' => 'Shop',
            'plugin' => 'shop',
            'server' => '',
            'db_host' => 'localhost',
            'db_port' => '3306',
            'db' => '',
            'db_username' => '',
            'db_password' => '',
            'is_enabled' => false
        ],
        [
            'name' => 'VIP',
            'plugin' => 'vip_riko',
            'server' => '',
            'db_host' => 'localhost',
            'db_port' => '3306',
            'db' => '',
            'db_username' => '',
            'db_password' => '',
            'is_enabled' => false
        ],
        [
            'name' => 'LK',
            'plugin' => 'lk_1mpulse',
            'server' => '',
            'db_host' => 'localhost',
            'db_port' => '3306',
            'db' => '',
            'db_username' => '',
            'db_password' => '',
            'is_enabled' => false
        ],
        [
            'name' => 'LR',
            'plugin' => 'levelranks',
            'server' => '',
            'db_host' => 'localhost',
            'db_port' => '3306',
            'db' => '',
            'db_username' => '',
            'db_password' => '',
            'is_enabled' => false
        ],
        [
            'name' => 'Shavit',
            'plugin' => 'shavit',
            'server' => '',
            'db_host' => 'localhost',
            'db_port' => '3306',
            'db' => '',
            'db_username' => '',
            'db_password' => '',
            'is_enabled' => false
        ],
    ];

    public function run()
    {
        foreach ($this->plugins as $plugin) {
            DB::table('plugin_modules')->insert([
                'name' => $plugin['name'],
                'server' => $plugin['server'],
                'plugin' => $plugin['plugin'],
                'db' => $plugin['db'],
                'db_host' => $plugin['db_host'],
                'db_port' => $plugin['db_port'],
                'db_username' => $plugin['db_username'],
                'db_password' => $plugin['db_password'],
                'is_enabled' => $plugin['is_enabled']
            ]);
        }
    }
}
