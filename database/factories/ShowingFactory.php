<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Showing;
use Faker\Generator as Faker;
use Gordesch\CineCarbon;

$factory->define(Showing::class, function (Faker $faker, $attrib = [
   'programming_id' => null
]) {
    $programming = null;
    if (array_key_exists('programming_id', $attrib)) {
        $programming_id = $attrib['programming_id'];
        $programming = App\Programming::whereId($programming_id)->with('week')->firstOrFail();
    } else {
        $programming_id = factory(App\Programming::class);
    }
    return [
        'ticketing_provider_id' => $faker->domainWord,
        'programming_id' => $programming_id,
        'datetime' => $faker->dateTimeBetween(
            (array_key_exists('programming_id', $attrib)) ? $programming->week->start : CineCarbon::now()->startOfWeek(),
            (array_key_exists('programming_id', $attrib)) ? $programming->week->end : CineCarbon::now()->endOfWeek()
        ),
        'preshow_duration_in_seconds' => 60 * 15, // 15 min
        'is_original version' => $faker->boolean,
        'is_3d' => $faker->boolean,
        'auditorium_number' => $faker->numberBetween(1, 6)
    ];
});
