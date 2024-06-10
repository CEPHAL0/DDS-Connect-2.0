<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            Form::create([
                "title" => fake()->sentence(5),
                "description" => fake()->paragraphs(4, true),
                "user_id" => $this->getRandomUser()->id,
                "status" => "open"
            ]);
        }
    }


    private function getRandomUser()
    {
        return User::where("role", "moderator")->inRandomOrder()->first();
    }
}
