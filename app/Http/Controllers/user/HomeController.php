<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Form;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $forms = Form::latest()->take(5)->get();
        $events = Event::latest()->take(5)->get();
        return view("user.app", compact("forms", "events"));
    }
}
