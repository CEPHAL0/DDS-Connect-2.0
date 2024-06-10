<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\Question;
use App\Models\Value;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forms = Form::all();

        foreach ($forms as $form) {
            for ($i = 0; $i < 10; $i++) {

                $questionType = fake()->randomElement(["single", "multiple", "short", "long"]);

                $question = Question::create([
                    "question" => fake()->sentence(4),
                    "type" => $questionType,
                    "form_id" => $form->id
                ]);

                if ($questionType == 'single' || $questionType == "multiple") {
                    for ($j = 0; $j < rand(3, 6); $j++) {
                        Value::create([
                            "question_id" => $question->id,
                            "value" => fake()->sentence(2)
                        ]);
                    }
                }
            }
        }
    }

    private function getRanomForm()
    {
        return Form::inRandomOrder()->first();
    }
}
