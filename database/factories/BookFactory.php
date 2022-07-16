<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 10),
            'title' => $this->faker->unique()->sentence(),
            'description' => $this->faker->paragraph(),
            'cover' => $this->faker->imageUrl(640, 480),
        ];
    }
}
