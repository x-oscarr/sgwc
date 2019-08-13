<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    protected $settings = [
        [
            'parameter' => 'Gtitle',
            'value' => 'Source<span>Game</span> Web Constructor'
        ],
        [
            'parameter' => 'Ptitle',
            'value' => '• SGWC •'
        ],
        [
            'parameter' => 'Ftitle',
            'value' => 'SGWC Footer'
        ],
        [
            'parameter' => 'Preloader',
            'value' => 'penguin.gif'
        ]
    ];

    public function run()
    {
        foreach ($this->settings as $setting) {
            DB::table('settings')->insert([
                'parameter' => $setting['parameter'],
                'value' => $setting['value'],
            ]);
        }
    }
}
