<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Comment;
use App\Models\User;
use App\Models\Course;
use App\Models\Post;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::factory(40)->create();

        $postId1 = Post::where('author_id', User::where('name', 'Johny Silverhand')->first())->first()->id;
        $postId2 = Post::where('author_id', User::where('name', 'Misty')->first())->first()->id;

        $user1 = User::where('name', 'Misty')->first();
        $user2 = User::where('name', 'Johny Silverhand')->first();
        $user3 = User::where('name', 'Jackie Welles')->first();

        Comment::factory([
            'post_id' => $postId1,
            'author_id' => $user2->id,
            'content' => 'Dziękuje za pozytywną opinię!.',
            'edited' =>  false
        ])->create();

        Comment::factory([
            'post_id' => $postId1,
            'author_id' => $user1->id,
            'content' => '⸜(｡˃ ᵕ ˂ )⸝♡',
            'edited' =>  false
        ])->create();

        Comment::factory([
            'post_id' => $postId2,
            'author_id' => $user3->id,
            'content' => 'Witam!',
            'edited' =>  false
        ])->create();
    }
}
