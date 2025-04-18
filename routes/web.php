<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/test',function () {
    return view('auth2.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
