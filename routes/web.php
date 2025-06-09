<?php

use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', function (Post $post) {
    if (!$post->published) {
        if (auth()->check() && auth()->user()->is_admin) {
            return view('posts.show', compact('post'));
        }
        abort(404);
    }
    return view('posts.show', compact('post'));
})->name('posts.show');

Route::post('/posts/{post}/like', [PostLikeController::class, 'store'])->name('posts.like');
Route::delete('/posts/{post}/like', [PostLikeController::class, 'destroy'])->name('posts.unlike');

Route::post('/posts/{post}/comments', [PostCommentController::class, 'store'])->name('posts.comments.store');
Route::delete('/posts/{post}/comments/{comment}', [PostCommentController::class, 'destroy'])->name('posts.comments.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');
    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register.form');

    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::post('/register', [UserController::class, 'register'])->name('register');
});

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');
