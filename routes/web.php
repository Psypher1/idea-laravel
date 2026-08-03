<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/signup', [RegisteredUserController::class, 'create'])->middleware('guest');
Route::post('/signup', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::get('/auth/signin', [SessionController::class, 'create'])->middleware('guest');
Route::post('/signin', [SessionController::class, 'store'])->middleware('guest');


Route::post('/signout', [SessionController::class, 'destroy'])->middleware('auth');

