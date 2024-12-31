<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/', function () {
    return view('home');
})->name('home');
Route::resource('posts', PostController::class);
Route::get('/', [PostController::class, 'index'])->name('home');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
