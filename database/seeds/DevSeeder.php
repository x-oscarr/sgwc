<?php

use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reports = factory(App\Report::class, 50)->make();
        foreach ($reports as $report) {
            $report->save();
        }

//        $user = \App\User::where('steam32', 'STEAM_1:0:72120179');
//        $rootRole = \PHPZen\LaravelRbac\Model\Role::where('slug', 'root');
//        $user->roles()->attach($rootRole->id);
    }
}
