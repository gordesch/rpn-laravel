<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Show;
use Faker\Generator as Faker;

$factory->define(Show::class, function (Faker $faker) {
    $title = $faker->name;
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'genre' => $faker->word(),
        'duration_in_seconds' => $faker->numberBetween(60 * 45, 60 * 140),
        'country' => $faker->country,
        'is_local_language' => $faker->boolean(),
        'year' => $faker->year(),
        'director' => $faker->name(),
        'cast' => $faker->name(),
        'synopsis' => $faker->paragraph(8),
        'audience' => $faker->numberBetween(4, 18),
    ];
});
