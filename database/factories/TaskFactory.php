<?php

namespace Database\Factories;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
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
            'title' => $faker->sentence,
            'short_description' => $faker->paragraph,
            'long_description' => $faker->text,
            'due_date' => $faker->dateTimeBetween('now', '+1 year'), // Due date within the next year
            'priority' => $faker->randomElement(['low', 'medium', 'high']),
            'status_id' => TaskStatus::inRandomOrder()->first()->id,
            'status' => $faker->randomElement(['To Do', 'In Progress', 'Done']),
            'created_by' => User::inRandomOrder()->first()->id,
            'assigned_to' => User::inRandomOrder()->first()->id,
            'is_recurring' => $faker->boolean,
            'recurring_task_id' => null, // Adjust as needed based on your logic
        ];
    }
}
