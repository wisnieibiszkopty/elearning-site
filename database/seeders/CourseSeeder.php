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

        $user1 = User::where('name', 'Johny Silverhand')->first();

        $course = Course::factory([
           'title' => 'Java Spring course',
           'author_id' => $user1->id,
           'code' => 'JAVA',
           'description' => 'Course for people wanting to start working as java backend developers'
        ])->create();

        // attaching example members to course
        $user2 = User::where('name', 'Misty')->first();
        $user3 = User::where('name', 'Jackie Welles')->first();

        $course->members()->attach($user1->id);
        $course->members()->attach($user2->id);
        $course->members()->attach($user3->id);

        $user4 = User::where('name', 'Judy Alvarez')->first();

        $course2 = Course::factory([
            'title' => 'Laravel course',
            'author_id' => $user4->id,
            'code' => 'LAR24',
            'description' => 'Course for classes about programming web applications'
        ])->create();

        $course2->members()->attach($user2->id);
        $course2->members()->attach($user3->id);
    }
}
