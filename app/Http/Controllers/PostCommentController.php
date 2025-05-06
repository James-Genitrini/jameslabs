<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function store(Post $post)
    {
        $comment = request('comment');
        if ($comment) {
            $post->comments()->create(['user_id' => auth()->id(), 'comment' => $comment]);
        }

        return back();
    }

    public function destroy(Post $post, Comment $comment)
    {
        if ($comment->user_id === auth()->id()) {
            $comment->delete();
        }
    
        return back();
    }
}
