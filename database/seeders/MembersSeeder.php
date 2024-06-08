<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            User::create([
                "name" => fake()->name(),
                "username" => fake()->userName(),
                "email" => fake()->email(),
                "password" => Hash::make("password"),
                "role" => "moderator",
                "profile_image_url" => fake()->randomElement(["user1.jfif", "user2.jfif", "user3.jfif", "user4.jfif", "user5.jfif", "user6.jfif",])
            ]);
        }
    }
}
