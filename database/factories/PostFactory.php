<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        // foreach (config('translatable.locales') as $locale) {
        //     $rules[$locale . '.title'] = 'string';
        //     $rules[$locale . '.full_text'] = 'string';
        // }

        // $data = [
        //     'author' => 'Gummibeer',
           
        //   ];

        return [
            'user_id' => rand(1, 5),
            'category_id' => rand(1, 5),
            'en' => [
                'title' => $this->faker->unique()->sentence,
                'body' =>  $this->faker->unique()->paragraph,
            ],
            'es' => [
                'title' => $this->faker->unique()->sentence,
                'body' =>  $this->faker->unique()->paragraph,
            ],
            'de' => [
                'title' => $this->faker->unique()->sentence,
                'body' =>  $this->faker->unique()->paragraph,
            ],
            // 'title' =>  $this->faker->unique()->sentence,
            // 'body' =>  $this->faker->unique()->paragraph,
            'image' => null
        ];
    }
}
