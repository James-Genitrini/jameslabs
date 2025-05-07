<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
    
    
        $allPosts = Post::where('published', true)
            ->withCount('comments')
            ->latest()
            ->get();

        $latestPosts = $allPosts->take(3);

        return view('home.index', compact( 'latestPosts'));
    }
}