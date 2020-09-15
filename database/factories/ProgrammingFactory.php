<?php

namespace Database\Factories;

use App\Models\Programming;
use App\Models\Week;
use App\Models\Show;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProgrammingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Programming::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'week_id' => Week::factory(),
            'show_id' => Show::factory(),
            /*
            // Commented to set it in controller
            'is_dubbed_version' => $this->faker->boolean,
            'is_original_version' => $this->faker->boolean,
            'is_2d' => $this->faker->boolean,
            'is_3d' => $this->faker->boolean,
            */
        ];
    }
}
