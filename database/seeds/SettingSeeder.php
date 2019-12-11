<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    protected $settings = [
        //design
        'Gtitle' => 'Source<span>Game</span> Web Constructor',
        'Ptitle' => '• SGWC •',
        'projectName' => 'Source Game Web Constructor',
        'preloaderPath' => 'img/preloaders/penguin.gif',
        'bgColor' => '#18191c',
        'bgPicture' => null,
        'bgSize' => 'cover',
        'bgPosition' => '50% 50%',
        'bgRepeat' => 'no-repeat',
        'bgAnimation' => '2',
        'sectionBackground' => 'rgba(255, 255, 255, 0.05)',
        'sectionBorder' => 'none',
        // pm

    ];

    public function run()
    {
        foreach ($this->settings as $parameter => $value) {
            DB::table('settings')->insert([
                'parameter' => $parameter,
                'value' => $value,
            ]);
        }
    }
}
