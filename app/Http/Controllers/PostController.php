<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
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

        $posts = $query->latest()->paginate(4);
        return view('posts.index', compact('posts'));
    }
}
