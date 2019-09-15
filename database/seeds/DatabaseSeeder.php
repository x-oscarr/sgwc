<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingSeeder::class);
        if(!class_exists(KTMSeeder::class)) {
            $this->call(PModuleSeeder::class);
        }
        else {
            $this->call(KTMSeeder::class);
        }
        $this->call(DevSeeder::class);
    }
}
