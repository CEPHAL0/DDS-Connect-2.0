<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormSubmitRequest;
use App\Models\Form;
use App\Models\Question;
use App\Models\Response;
use App\Models\ResponseUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::latest()->get();
        return view("user.forms.index", compact("forms"));
    }

    public function fill(int $formId)
    {
        $form = Form::with(["questions", "questions.values"])->findOrFail($formId);

        $user = auth()->user();
        $responseUserExists = ResponseUser::where("form_id", $form->id)->where("user_id", $user->id)->exists();

        if ($responseUserExists) {
            return redirect(route("userForms.view", $form->id));
        }

        return view("user.forms.fill", compact("form"));
    }


    public function view(int $formId)
    {
        $user = auth()->user();
        $form = Form::findOrFail($formId);

        $responseUserExists = ResponseUser::where("form_id", $form->id)->where("user_id", $user->id)->exists();

        if (!$responseUserExists) {
            return redirect(route("userForms.fill", $form->id));
        }
        return view("user.forms.view", compact("form"));
    }




    public function submit(FormSubmitRequest $request, int $formId)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $questions = $data["questions"];
            $values = $data["values"];

            if (count($questions) != count($values)) {
                throw new Exception("All Questions not filled");
            }

            $user = auth()->user();
            $form = Form::where("id", $formId)->where("status", "open")->firstOrFail();


            $responseUser = ResponseUser::create([
                "user_id" => $user->id,
                "form_id" => $form->id
            ]);

            foreach ($questions as $index => $questionId) {
                $question = Question::where("id", $questionId)->where("form_id", $form->id)->firstOrFail();

                if ($question->type == "multiple") {

                    $valuesQuestion = $values[$question->id];
                    $arrayValues = implode(", ", $valuesQuestion);

                    $response = Response::create([
                        "response_user_id" => $responseUser->id,
                        "question" => $question->question,
                        "answer" => $arrayValues,
                        "question_id" => $question->id
                    ]);

                } else {


                    $responseValue = $values[$question->id];

                    $response = Response::create([
                        "response_user_id" => $responseUser->id,
                        "question" => $question->question,
                        "answer" => $responseValue,
                        "question_id" => $question->id
                    ]);
                }
            }
            DB::commit();
            return redirect(route('userForms.index'))->with("success", "Form Filled Successfully");

        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(["error" => "Failed to fill the form"]);
        }


    }
}
