<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'title' => fake()->sentence(4),
            'description' => fake()->paragraph(4),
            'price' => fake()->randomFloat(2, 1000, 5000),
            'icon' => 'https://via.placeholder.com/600x400?text=Service+Image',
        ];
    }
}
