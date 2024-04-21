<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attachment>
 */
class AttachmentFactory extends Factory
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
            'attachment_path' => $faker->imageUrl(), // Replace with actual attachment path logic
            'attached_by' => User::inRandomOrder()->first()->id,
            'task_id' => Task::inRandomOrder()->first()->id,
        ];
    }
}
