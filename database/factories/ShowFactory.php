<?php

namespace Database\Factories;

use App\Models\Show;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShowFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Show::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->name();
        return [
            'title'               => $title,
            'slug'                => Str::slug($title),
            'genre'               => $this->faker->word(),
            'duration_in_seconds' => $this->faker->numberBetween(60 * 45, 60 * 140),
            'country'             => $this->faker->country,
            'is_local_language'   => $this->faker->boolean(),
            'year'                => $this->faker->year(),
            'director'            => $this->faker->name(),
            'cast'                => $this->faker->name(),
            'synopsis'            => $this->faker->paragraph(8),
            'audience'            => $this->faker->numberBetween(4, 18),
        ];
    }
}
