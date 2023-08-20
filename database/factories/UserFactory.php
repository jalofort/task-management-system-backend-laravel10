<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $password = password_hash('Test.2023$', PASSWORD_DEFAULT);

        return [
            'first_name' =>  $this->faker->name(),
            'last_name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => $password,
            'access_token' => Str::random(60),
            'created_at' => time(),
        ];
    }
}
