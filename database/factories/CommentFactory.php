<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => rand(1, 10),
            'user_id' => rand(1, 6),
            'body' => $this->faker->paragraph
        ];
    }
}
