<?php

namespace Database\Factories;

use App\Models\Homework;
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
        $filePath = $this->faker->image(storage_path('app/public/tasks'), 400, 300, null, false);

        return [
            'author_id' => User::factory(),
            'homework_id' => Homework::factory(),
            'file_path' => $filePath,
            'filename' => fake()->firstName(),
            'sended_on_time' => fake()->boolean(),
            'comment' => ''
        ];
    }
}
