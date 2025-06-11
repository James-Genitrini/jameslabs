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

        $latestPosts = $allPosts->take(4);

        $mostLikedPosts = Post::where('published', true) // Ajout de cette ligne pour filtrer les posts publiés
            ->withCount('likes')
            ->withCount('comments')
            ->orderByDesc('likes_count')
            ->take(4)
            ->get();

        return view('home.index', compact('latestPosts', 'mostLikedPosts'));
    }
}