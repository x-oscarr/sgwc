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
    }
}
