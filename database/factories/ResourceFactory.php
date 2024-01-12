<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Core\Helper;

use App\Models\Course;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resource>
 */
class ResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $filePath = $this->faker->image(storage_path('app/public/resources'), 400, 300, null, false);
        $filesize = filesize($filePath);
        $filesize = Helper::formatSizeUnits($filesize);

        return [
            'course_id' => Course::factory(),
            'name' => fake()->text(),
            'file_path' => $filePath,
            'file_size' => $filesize
        ];
    }
}
