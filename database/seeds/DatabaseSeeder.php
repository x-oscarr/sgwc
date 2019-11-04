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
        $this->call(RoleSeeder::class);
        $this->call(SModuleSeeder::class);
        $this->call(DefaultMenuItemSeeder::class);

        if(!class_exists(KTMSeeder::class)) {
            $this->call(PModuleSeeder::class);
        }
        else {
            $this->call(KTMSeeder::class);
        }
        // Dev Seeder
        $this->call(DevSeeder::class);
    }
}
