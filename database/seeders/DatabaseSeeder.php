<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CourseSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            ResourceSeeder::class,
            HomeworkSeeder::class,
            TaskSeeder::class,
            ChatSeeder::class
        ]);
    }
}
