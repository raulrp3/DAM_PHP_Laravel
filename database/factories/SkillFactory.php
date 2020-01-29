<?php

use Faker\Generator as Faker;
use App\Models\Skill;

$factory->define(Skill::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->sentence(3),
    ];
});
