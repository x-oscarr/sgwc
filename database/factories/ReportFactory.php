<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Report;
use Faker\Generator as Faker;

$factory->define(Report::class, function (Faker $faker) {
    return [
        'server' => 1,
        'type' => "player_report",
        'desctription' => $faker->text(300),
        'sender' => "STEAM:1:0:".rand(1000000, 9999999),
        'sender_id' => null,
        'perpetrator' => "STEAM:1:0:".rand(1000000, 9999999),
        'perpetrator_id' => null,
        'file' => null,
        'status' => null,
        'time' => Carbon\Carbon::now(),
        'created_at' => Carbon\Carbon::now()
    ];
});
