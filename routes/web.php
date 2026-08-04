<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/ideas');

//  Route::middleware('auth')->group(function () {
//     Route::get('/ideas/create', [IdeaController::class, 'create'])->name('idea.create');
//     Route::post('/ideas', [IdeaController::class, 'store'])->name('idea.store');
//     Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->name('idea.edit');
//     Route::patch('/ideas/{idea}', [IdeaController::class, 'update'])->name('idea.update');
//     Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->name('idea.destroy');
// });

Route::get('/ideas', [IdeaController::class, 'index'])->middleware('auth');
Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->name('idea.show')->middleware('auth');

Route::get('/auth/signup', [RegisteredUserController::class, 'create'])->middleware('guest');
Route::post('/signup', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::get('/auth/signin', [SessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('/signin', [SessionController::class, 'store'])->middleware('guest');

Route::post('/signout', [SessionController::class, 'destroy'])->middleware('auth');
