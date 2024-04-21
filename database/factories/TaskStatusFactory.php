<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskStatus>
 */
class TaskStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;
        return [
            'name' => $faker->word,
            'description' => $faker->sentence,
            'color' => $faker->hexColor,
            'icon' => $faker->randomElement(['fa-check', 'fa-times', 'fa-info-circle']),
        ];
    }
}
