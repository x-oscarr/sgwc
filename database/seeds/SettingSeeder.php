<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'parameter' => 'Gtitle',
                'value' => 'Source<span>Game</span> Web Constructor'
            ],
            [
                'parameter' => 'Ptitle',
                'value' => '&bull; SGWC &bull;'
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

        foreach ($settings as $setting) {
            DB::table('settings')->insert([
                'parameter' => $setting['parameter'],
                'value' => $setting['value'],
            ]);
        }
    }
}
