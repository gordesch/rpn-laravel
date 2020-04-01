<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Programming;
use Faker\Generator as Faker;

$factory->define(Programming::class, function (Faker $faker) {
    return [
        'week_id' => factory(App\Week::class),
        'show_id' => factory(App\Show::class),
        /*
        // Commented to set it in controller
        'is_dubbed_version' => $faker->boolean,
        'is_original_version' => $faker->boolean,
        'is_2d' => $faker->boolean,
        'is_3d' => $faker->boolean,
        */
    ];
});
