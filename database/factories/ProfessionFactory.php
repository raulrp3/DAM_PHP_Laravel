<?php

use Faker\Generator as Faker;
use App\Models\Profession;

$factory->define(Profession::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3, false)
    ];
});
