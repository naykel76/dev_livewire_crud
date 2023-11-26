<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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

        User::factory(10)->create();
    }
}
