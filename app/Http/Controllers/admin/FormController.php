<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\_FormRequest;
use App\Models\Form;
use Illuminate\Http\Request;

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
        return redirect(route("admin.home"))->with("success", "Form created successfully");
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
        return redirect(route('admin.home'))->with("success", "Toggle form status successfully");
    }


    public function addQuestionsToForm(int $formId)
    {
        $form = Form::findOrFail($formId);
        if (count($form->questions) != 0) {
            return redirect(route("adminForms.index"))->withErrors(["error", "Form Already Has Questions"]);
        }
        return view("admin.forms.addQuestions", compact("form"));
    }

    public function storeQuestionsToForm(Request $request)
    {
        dd($request);
    }
}
