<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\FormController as AdminFormController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\MemberController as AdminMemberController;

Route::get('/', function () {
    if (!Auth::user()) {
        return redirect('/login');
    }
    return view("app");
});


Route::view('/login', 'auth.login')->name("login");

Route::view('/register', 'auth.register')->name('register');



Route::prefix('admin')->middleware(["auth", 'role:admin', 'preventBackHistory'])->group(
    function () {
        // Route::view("/", 'admin.app')->name("admin.home");
    
        Route::get("/forms", [AdminFormController::class, "index"])->name("adminForms.index");
        Route::get("/", [AdminHomeController::class, "home"])->name("admin.home");
        Route::get("/members", [AdminMemberController::class, "index"])->name("adminMembers.index");

    }
);

Route::middleware(["auth", 'role:admin,moderator', 'preventBackHistory'])->group(
    function () {
        Route::get("/forms/create", [AdminFormController::class, "create"])->name("forms.create");
        Route::post("/forms/store", [AdminFormController::class, "store"])->name("forms.store");
        Route::post("/forms/toggle/{formId}", [AdminFormController::class, "toggleFormStatus"])->name("forms.toggleFormStatus");
        Route::get("/forms/questions/add/{formId}", [AdminFormController::class, "addQuestionsToForm"])->name("forms.addQuestions");
        Route::post("/forms/questions/store/{formId}", [AdminFormController::class, "storeQuestionsToForm"])->name("forms.storeQuestions");
        Route::get("/form/view/questions/{formId}", [AdminFormController::class, "viewForm"])->name("admin.viewForm");
    }
);

Route::middleware(["auth", 'role:user'])->group(
    function () {
        Route::view("/home", 'user.app')->name("user.home");
    }
);