<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6),
            'price' => fake()->randomFloat(2, 5, 500),
            'content' => fake()->paragraph(5),
            'image' => 'https://source.unsplash.com/600x400/?post,' . fake()->word(),
        ];
    }
}
