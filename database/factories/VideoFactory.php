<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'show_id' => factory(App\Show::class),
        'is_original_version' => $faker->boolean,
        'youtube_id' => $faker->domainWord
    ];
});
