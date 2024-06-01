<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassType>
 */
class ClassTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(rand(1, 2), true),
            'description' => fake()->paragraph(1),
            'duration_in_minutes' => rand(15, 90),
            // 'duration_in_minutes' => fake()->randomNumber(2),
        ];
    }
}
