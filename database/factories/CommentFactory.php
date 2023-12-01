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
            'content' => $this->faker->paragraphs(3, true),
            'approved' => $this->faker->boolean(80),
            'author_id' => 31999873,
            'created_at' => $this->faker->dateTimeBetween('-1 year'),
        ];
    }
}
