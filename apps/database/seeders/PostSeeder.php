<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Get a list of user IDs to associate with posts
        $userIds = DB::table('users')->pluck('id')->toArray();

        foreach (range(1, 50) as $index) {
            DB::table('posts')->insert([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'created_by' => $faker->randomElement($userIds),
                'created_at' => now(),
            ]);
        }
    }
}