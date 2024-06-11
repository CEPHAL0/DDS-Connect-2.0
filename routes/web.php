<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\FormController as AdminFormController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\MemberController as AdminMemberController;
use App\Http\Controllers\admin\EventController as AdminEventController;
use App\Http\Controllers\admin\ResponseController as AdminResponseController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\user\FormController as UserFormController;
use App\Http\Controllers\user\EventController as UserEventController;
use App\Http\Controllers\user\HomeController as UserHomeController;

Route::get('/', function () {
    if (!Auth::user()) {
        return redirect('/login');
    }
    return view("app");
});


Route::view('/login', 'auth.login')->name("login");

Route::view('/register', 'auth.register')->name('register');

Route::post("/logout", [AuthController::class, "logout"])->name("logout");



Route::prefix('admin')->middleware(["auth", 'role:admin', 'preventBackHistory'])->group(
    function () {
        // Route::view("/", 'admin.app')->name("admin.home");
    
        Route::get("/forms", [AdminFormController::class, "index"])->name("adminForms.index");
        Route::get("/", [AdminHomeController::class, "home"])->name("admin.home");
        Route::get("/members", [AdminMemberController::class, "index"])->name("adminMembers.index");
        Route::get("/members/create", [AdminMemberController::class, "create"])->name("adminMembers.create");
        Route::get("/members/edit/{memberId}", [AdminMemberController::class, "edit"])->name("adminMembers.edit");
        Route::post("/members/store", [AdminMemberController::class, "store"])->name("adminMembers.store");
        Route::put("/members/update/{memberId}", [AdminMemberController::class, "update"])->name("adminMembers.update");
        Route::delete("/members/delete/{memberId}", [AdminMemberController::class, "destroy"])->name("adminMembers.destroy");
        Route::get("/events", [AdminEventController::class, "index"])->name("adminEvents.index");
        Route::get("/events/show/{eventId}", [AdminEventController::class, "show"])->name("adminEvents.show");
        Route::get("/events/create", [AdminEventController::class, "create"])->name("adminEvents.create");
        Route::post("/events/store", [AdminEventController::class, "store"])->name('adminEvents.store');
        Route::get("/events/edit/{eventId}", [AdminEventController::class, "edit"])->name("adminEvents.edit");
        Route::put("/events/update/{eventId}", [AdminEventController::class, "update"])->name("adminEvents.update");
        Route::delete("/events/delete/{eventId}", [AdminEventController::class, "destroy"])->name("adminEvents.destroy");
        Route::get("/events/toggle/{eventId}", [AdminEventController::class, "toggleStatus"])->name("adminEvents.toggleStatus");

        Route::get("/responses", [AdminResponseController::class, "index"])->name("adminResponses.index");
        Route::get("/responses/view/{formId}", [AdminResponseController::class, "showResponse"])->name("adminResponses.showResponse");
        Route::get("/responses/export/{formId}", [AdminResponseController::class, "export"])->name("adminResponses.export");
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
        Route::delete("/form/delete/{formId}", [AdminFormController::class, "destroy"])->name("adminForms.destroy");
    }
);

Route::middleware(["auth", 'role:user'])->group(
    function () {

        Route::get("/home", [UserHomeController::class, "index"])->name("user.home");

        Route::get("/forms", [UserFormController::class, "index"])->name("userForms.index");
        Route::get("/forms/fill/{formId}", [UserFormController::class, "fill"])->name("userForms.fill");
        Route::get("/forms/view/{formId}", [UserFormController::class, "view"])->name("userForms.view");
        Route::post("/forms/submit/{formId}", [UserFormController::class, "submit"])->name("userForms.submit");

        Route::get("/events", [UserEventController::class, "index"])->name("userEvents.index");
        Route::get("/events/show/{eventId}", [UserEventController::class, "show"])->name("userEvents.show");


        Route::get('/stripe', [StripePaymentController::class, 'stripe'])->name('stripe.index');
        Route::get('stripe/checkout', [StripePaymentController::class, 'stripeCheckout'])->name('stripe.checkout');
        Route::get('stripe/checkout/success/{eventId}', [StripePaymentController::class, 'stripeCheckoutSuccess'])->name('stripe.checkout.success');

    }
);