<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // generic users
        User::factory(20)->create();
        User::factory(5)->state([
            'role' => 1
        ])->create();

        // users for showing app
        User::factory([
            'name' => 'Johny Silverhand',
            'email' => 'johny@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'company' => 'Militech',
            'role' => '1',
            'remember_token' => Str::random(10)
        ])->create();

        User::factory([
            'name' => 'Jackie Welles',
            'email' => 'jackie@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'company' => 'Afterlife',
            'role' => '0',
            'remember_token' => Str::random(10)
        ])->create();

        User::factory([
            'name' => 'Misty',
            'email' => 'misty@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'company' => 'Arasaka',
            'role' => '0',
            'remember_token' => Str::random(10)
        ])->create();

        User::factory([
            'name' => 'Judy Alvarez',
            'email' => 'judy@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'company' => 'Trauma Team',
            'role' => '1',
            'remember_token' => Str::random(10)
        ])->create();
    }
}
