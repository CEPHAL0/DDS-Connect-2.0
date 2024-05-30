<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!Auth::user()) {
        return redirect('/login');
    }
    return view("app");
});


// Route::view('/login', 'auth.login')->name("login");

// Route::view('/register', 'auth.register')->name('register');



Route::prefix('admin')->middleware(["auth", 'role:admin', 'preventBackHistory'])->group(
    function () {
        Route::view("/home", 'admin.app')->name("admin.home");
    }
);

Route::middleware(["auth", 'role:user'])->group(
    function () {
        Route::view("/home", 'user.app')->name("user.home");
    }
);