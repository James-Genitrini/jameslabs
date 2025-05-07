<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Post::where('published', true)->withCount('comments');
    
        if ($search) {
            $keywords = preg_split('/\s+/', $search); // Découpe par espace
    
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('title', 'like', "%{$word}%")
                      ->orWhere('synopsis', 'like', "%{$word}%")
                      ->orWhereJsonContains('tags', $word);
                }
            });
        }
    
        $posts = $query->latest()->get();
    
        $allPosts = \App\Models\Post::where('published', true)
            ->withCount('comments')
            ->latest()
            ->get();

        $latestPosts = $allPosts->take(3);

        return view('home.index', compact('posts', 'search', 'latestPosts'));
    }
}