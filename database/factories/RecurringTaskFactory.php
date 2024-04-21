<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecurringTask>
 */
class RecurringTaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;
        $start_date = $faker->date;
        $end_date = $faker->optional()->dateBetween($start_date, $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'));

        return [
            'title' => $faker->sentence,
            'short_description' => $faker->paragraph,
            'long_description' => $faker->text,
            'frequency' => $faker->randomElement(['daily', 'weekly', 'monthly']),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'created_by' => User::inRandomOrder()->first()->id
        ];
    }
}
