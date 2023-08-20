<?php

namespace Database\Factories;

use App\Models\Group;
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
        $title = $this->faker->name();

        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'is_completed' => rand(0, 1),
            'group_id' => Group::factory(),
            'created_at' => time(),
            'created_by' => User::factory(),
        ];
    }
}
