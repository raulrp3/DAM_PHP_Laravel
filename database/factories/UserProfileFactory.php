<?php

use Faker\Generator as Faker;
use App\Models\UserProfile;
use App\Models\Profession;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'bio' => $faker->paragraph,
        'profession_id' => Profession::all()->random()->id,
    ];
});
