<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $query = Post::where('published', true)->withCount('comments');

        $posts = $query->latest()->paginate(9);
        
        return view('posts.index', compact('posts'));
    }
}
