<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 2),
            'title' => $this->createTitle(),
            'director' => $this->faker->name,
            'description' => $this->faker->paragraph(3),
            'poster' => $this->faker->imageUrl($width = 200, $height = 400),
            'length' => $this->faker->numberBetween(0, 200),
            'status' => $this->faker->boolean(50),
        ];
    }


    private function createTitle() {
        $title_array_to_string = implode(' ', $this->faker->words(3));

        $capitalized_title = ucwords($title_array_to_string);

        return $capitalized_title;
    }
}
