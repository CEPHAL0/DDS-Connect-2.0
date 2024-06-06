<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $forms = Form::latest()->take(5)->get();
        return view("admin.app", compact("forms"));
    }
}
