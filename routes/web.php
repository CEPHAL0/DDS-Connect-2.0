<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});


Route::get('/login', function () {
    return view('auth.login');
})->name("login");

Route::get('/register', function () {
    return view('auth.register');
})->name('register');



Route::prefix('admin')->middleware(["auth", 'role:admin', 'preventBackHistory'])->group(
    function () {
        Route::view("/home", 'admin.home')->name("admin.home");
    }
);

Route::middleware(["auth", 'role:user'])->group(
    function () {
        Route::get("/home", function () {
            return view('user.app');
        })->name("user.home");
    }
);