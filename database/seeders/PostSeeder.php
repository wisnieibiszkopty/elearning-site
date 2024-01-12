<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Course;
use App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Post::factory(30)->create();

        $courseId = Course::where('code', 'JAVA')->first()->id;

        $user1 = User::where('name', 'Misty')->first();
        $user2 = User::where('name', 'Johny Silverhand')->first();
        $user3 = User::where('name', 'Jackie Welles')->first();

        Post::factory([
            'course_id' => $courseId,
            'author_id' => $user1->id,
            'content' => 'Doskonała prezentacja! Jestem zaintrygowany tym, jak łatwo można implementować różne funkcje w Laravelu. Na pewno skorzystam z tych informacji w moim następnym projekcie.',
            'edited' =>  false
        ])->create();

        Post::factory([
            'course_id' => $courseId,
            'author_id' => $user2->id,
            'content' => 'Fascynujące wprowadzenie do Laravela! Bardzo podoba mi się sposób, w jaki omawiane są koncepty. Czekam na kolejne lekcje!',
            'edited' => false
        ])->create();

        Post::factory([
            'course_id' => $courseId,
            'author_id' => $user3->id,
            'content' => 'Właśnie zakończyłem pierwszy moduł kursu, a już teraz czuję, że zrozumiałem wiele. Twoje wyjaśnienia są klarowne, a kod przykłady są bardzo pomocne. Nie mogę się doczekać, aby przejść dalej!',
            'edited' =>  false
        ])->create();
    }
}
