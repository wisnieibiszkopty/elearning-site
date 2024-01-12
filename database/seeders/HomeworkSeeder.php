<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Homework;
use App\Models\Course;

class HomeworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Homework::factory(10)->create();

        $courseId = Course::where('code', 'JAVA')->first()->id;

        Homework::factory([
            'course_id' => $courseId,
            'name' => 'zadanie 1',
            'description' => 'Proszę utworzyć nowy projekt korzystając z frameworka Laravel',
            'available' => true,
            'finish_date' => fake()->date('Y-m-d H:i:s')
        ])->create();

        Homework::factory([
            'course_id' => $courseId,
            'name' => 'lab 2',
            'description' => 'Proszę zrobić laboratorium 2 ze skryptu',
            'available' => true,
            'finish_date' => fake()->date('Y-m-d H:i:s')
        ])->create();
    }
}
