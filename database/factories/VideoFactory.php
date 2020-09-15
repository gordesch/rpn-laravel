<?php

namespace Database\Factories;

use App\Models\Show;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'show_id'             => Show::factory(),
            'is_original_version' => $this->faker->boolean,
            'youtube_id'          => $this->faker->domainWord
        ];
    }
}
