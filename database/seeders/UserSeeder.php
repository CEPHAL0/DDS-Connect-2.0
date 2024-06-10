<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 30; $i++) {
            User::create([
                "name" => fake()->name(),
                "username" => fake()->userName(),
                "email" => fake()->email(),
                "password" => Hash::make("password"),
                "role" => "user",
                "profile_image_url" => "default.jpg"
            ]);
        }
    }
}
