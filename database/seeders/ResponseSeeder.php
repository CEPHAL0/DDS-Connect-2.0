<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\Response;
use App\Models\ResponseUser;
use App\Models\User;
use App\Models\Value;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $forms = Form::all();
        foreach ($users as $user) {

            foreach ($forms as $form) {
                $responseUser = ResponseUser::create([
                    "form_id" => $form->id,
                    "user_id" => $user->id
                ]);

                $questions = $form->questions;

                foreach ($questions as $question) {

                    if ($question->type == "single") {
                        $values = $question->values;

                        $value = Value::where("question_id", $question->id)->inRandomOrder()->first();

                        Response::create([
                            "response_user_id" => $responseUser->id,
                            "question" => $question->question,
                            "answer" => $value->value,
                            "question_id" => $question->id
                        ]);
                    } else if ($question->type == "multiple") {

                        $values = $question->values;

                        $valueCount = count($values);

                        $valuesArray = [];

                        $valuesToEnter = Value::where("question_id", $question->id)->take(random_int(1, $valueCount))->get();

                        foreach ($valuesToEnter as $index => $valueToEnter) {
                            $valuesArray[$index] = $valueToEnter->value;
                        }

                        $valuesToInsert = implode(", ", $valuesArray);

                        Response::create([
                            "response_user_id" => $responseUser->id,
                            "question" => $question->question,
                            "answer" => $valuesToInsert,
                            "question_id" => $question->id
                        ]);
                    } else if ($question->type == "short") {
                        Response::create([
                            "response_user_id" => $responseUser->id,
                            "question" => $question->question,
                            "answer" => fake()->sentence(7),
                            "question_id" => $question->id
                        ]);
                    } else if ($question->type == 'long') {
                        Response::create([
                            "response_user_id" => $responseUser->id,
                            "question" => $question->question,
                            "answer" => fake()->sentence(20),
                            "question_id" => $question->id
                        ]);
                    }
                }
            }
        }
    }
}
