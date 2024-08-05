<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        foreach (range(1, 100) as $index) {
            DB::table('users')->insert([
                'username' => $faker->unique()->userName,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make($faker->password),
                'remember_token' => $faker->optional()->uuid,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}