<?php

use Faker\Generator as Faker;
use App\Models\Team;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
    ];
});
