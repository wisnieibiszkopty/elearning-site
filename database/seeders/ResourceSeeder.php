<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Resource;
use App\Models\Course;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Resource::factory(5)->create();

        $id = Course::where('code', 'JAVA')->first();

        Resource::factory([
            'course_id' => $id,
            'name' => 'Laravel skrypt',
        ])->create();

        Resource::factory([
            'course_id' => $id,
            'name' => 'Programowanie aplikacji internetowych',
        ])->create();
    }
}
