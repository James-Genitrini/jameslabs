<?php

use App\Http\Controllers\PostLikeController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('posts.show', compact('post'));
})->name('posts.show');

Route::post('/posts/{post}/like', [PostLikeController::class, 'store'])->name('posts.like');
Route::delete('/posts/{post}/like', [PostLikeController::class, 'destroy'])->name('posts.unlike');