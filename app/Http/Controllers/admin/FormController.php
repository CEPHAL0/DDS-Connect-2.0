<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\_FormRequest;
use App\Models\Form;
use App\Models\Question;
use App\Models\Value;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::all();
        return view("admin.forms.index", compact("forms"));
    }

    public function create()
    {
        $user = auth()->user();
        return view("admin.forms.create", compact("user"));
    }

    public function store(_FormRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $data["user_id"] = $user->id;
        $form = Form::create($data);

        return redirect(route("forms.addQuestions", $form->id))->with("success", "Form Created Successfully");

    }

    public function toggleFormStatus(Request $request, int $formId)
    {
        $form = Form::findOrFail($formId);

        if ($form->status == "open") {
            $updated = $form->update(["status" => "closed"]);
        } else {
            $updated = $form->update(["status" => "open"]);
        }
        $form->save();
        $form->refresh();
        return redirect()->back()->with("success", "Toggle form status successfully");
    }


    public function addQuestionsToForm(int $formId)
    {
        $form = Form::findOrFail($formId);
        if (count($form->questions) != 0) {
            return redirect(route("adminForms.index"))->withErrors(["error", "Form Already Has Questions"]);
        }
        return view("admin.forms.addQuestions", compact("form"));
    }

    public function storeQuestionsToForm(Request $request, int $formId)
    {
        $data = $request->input();

        $form = Form::findOrFail($formId);

        if (count($form->questions) > 0) {
            throw new Exception("Form already has questions");
        }

        $questions = $data['questions'];
        $types = $data["type"];

        $questionCount = count($questions);
        $values = [];
        $newIndex = 0;

        // Resetting values index
        foreach ($data["values"] as $value) {
            $values[$newIndex] = $value;
            $newIndex++;
        }


        foreach ($questions as $index => $question) {
            $question = Question::create([
                "question" => $question,
                "type" => $types[$index],
                "form_id" => $form->id
            ]);

            if ($question->type == "single" || $question->type == 'multiple') {
                foreach ($values[$index] as $indexValue => $value) {
                    $value = Value::create([
                        "question_id" => $question->id,
                        "value" => $value
                    ]);
                }
            }
        }

        return redirect(route("adminForms.index"))->with("success", "Added Questions to form successfully");
    }


    public function viewForm(int $formId)
    {
        $form = Form::with(["questions", "questions.values"])->findOrFail($formId);
        return view('admin.forms.view', compact("form"));
    }

    public function destroy(int $formId)
    {
        DB::beginTransaction();
        try {
            $form = Form::findOrFail($formId);
            $questions = $form->questions;

            foreach ($questions as $question) {
                $values = $question->values;
                if ($values) {
                    foreach ($values as $value) {
                        $value->delete();
                    }
                }
                $question->delete();
            }

            $form->delete();
            DB::commit();
            return redirect(route("adminForms.index"))->with("success", "Form Deleted Successfully");

        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(["error" => "Failed to delete form"]);
        }
    }
}
