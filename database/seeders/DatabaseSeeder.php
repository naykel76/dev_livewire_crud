<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Nathan Watts',
            'email' => 'nathan@naykel.com.au',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Jimmy Peters',
            'email' => 'jimmy@example.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
        ]);

        User::factory(5)->create();
        Post::factory(5)->create();
    }
}
