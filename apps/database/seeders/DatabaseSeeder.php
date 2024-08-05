<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the UserSeeder to populate the users table
        $this->call(UserSeeder::class);

        // Call the PostSeeder to populate the posts table
        $this->call(PostSeeder::class);
    }
}
