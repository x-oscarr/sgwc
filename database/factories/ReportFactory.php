<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Report;
use Faker\Generator as Faker;

$factory->define(Report::class, function (Faker $faker) {
    return [
        'server_id' => rand(1, 2),
        'type' => "player_report",
        'description' => $faker->text(300),
        'sender_name' => $faker->userName,
        'sender_auth' => "STEAM_1:0:".rand(10000000, 99999999),
        'sender_id' => null,
        'perpetrator_name' => $faker->userName,
        'perpetrator_auth' => "STEAM_1:0:".rand(10000000, 99999999),
        'perpetrator_id' => null,
        'file' => null,
        'status' => rand(0, 1) == 1 ? rand(0, 1) : null,
        'time' => Carbon\Carbon::now(),
        'created_at' => Carbon\Carbon::now()
    ];
});
