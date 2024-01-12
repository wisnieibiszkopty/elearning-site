<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Chat;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::where('name', 'Johny Silverhand')->first()->id;
        $user2 = User::where('name', 'Misty')->first()->id;
        $user3 = User::where('name', 'Jackie Welles')->first()->id;

        $chat1 = Chat::factory()->create();
        $chat1->users()->attach($user1);
        $chat1->users()->attach($user2);

        $chat2 = Chat::factory()->create();
        $chat2->users()->attach($user1);
        $chat2->users()->attach($user3);

        $chat3 = Chat::factory()->create();
        $chat3->users()->attach($user2);
        $chat3->users()->attach($user3);
    }
}
