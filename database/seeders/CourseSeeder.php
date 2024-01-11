<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Course;
use App\Models\User;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::factory(5)->create();

        $user1 = User::where('name', 'Johny Silverhand')->get();

        Course::factory([
           'title' => 'Java Spring course',
           'author_id' => $user1->id,
           'code' => 'JAVA',
           'description' => 'Course for people wanting to start working as java backend developers'
        ]);

        $user2 = User::where('name', 'Judy Alvarez')->get();

        Course::factory([
            'title' => 'Laravel course',
            'author_id' => $user2->id,
            'code' => 'LAR24',
            'description' => 'Course for classes about programming web applications'
        ]);
    }
}
