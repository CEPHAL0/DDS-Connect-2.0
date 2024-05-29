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

Route::get("/home", function () {
    return view("app");
});