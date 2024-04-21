<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;


    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class; // Replace with your user model class


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $faker = $this->faker;

        return [
            'email' => $faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'name' => $faker->userName(),
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'birth_date' => $faker->optional()->date,
            'gender' => $faker->optional()->randomElement(['male', 'female']),
            'profile_picture' => null,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
