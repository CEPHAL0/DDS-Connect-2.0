<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\ResponseUser;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function index()
    {
        $forms = Form::latest()->get();
        $responseUsers = ResponseUser::latest()->take(3)->get();
        return view("admin.responses.index", compact("responseUsers", "forms"));
    }

    public function showResponse(int $formId)
    {
        $form = Form::with(["responseUsers", "responseUsers.responses"])->findOrFail($formId);


        return view("admin.responses.show", compact("form"));
    }
}
