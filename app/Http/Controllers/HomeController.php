<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = \App\Models\Post::where('published', true)->withCount('comments')->latest()->get();
        return view('home.index', compact('posts'));

    }
}
