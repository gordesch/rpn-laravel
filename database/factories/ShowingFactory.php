<?php

namespace Database\Factories;

use App\Models\Programming;
use App\Models\Showing;
use Faker\Generator as Faker;
use Gordesch\CineCarbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShowingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Showing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ticketing_provider_id'       => $this->faker->domainWord,
            'programming_id'              => Programming::factory(),
            'datetime'                    => function (array $attributes) {
                return $this->faker->dateTimeBetween(
                    Programming::find($attributes['programming_id'])->week->start,
                    Programming::find($attributes['programming_id'])->week->end
                );
            },
            'preshow_duration_in_seconds' => 60 * 15, // 15 min
            'is_original_version'         => $this->faker->boolean,
            'is_3d'                       => $this->faker->boolean,
            'auditorium_number'           => $this->faker->numberBetween(1, 6),
        ];
    }
}
