<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Week;
use Faker\Generator as Faker;
use Gordesch\CineCarbon;
use Carbon\Carbon;

$factory->define(Week::class, function (Faker $faker) {

    return [
        'number' => Carbon::parse($faker->unique()->dateTimeBetween('now', '+ 6 months'))->isoFormat('GGGG-WW'),
    ];
});
