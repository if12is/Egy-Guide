<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|min:5'
        ]);
        $comment = Comment::create([
            'body' => $request->body,
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id,
            'user_id' => auth()->id()
        ]);

        return back()->with('success', 'Comment added successfully');
    }
    public function store_reply(Request $request)
    {
        $request->validate([
            'body' => 'required|min:5'
        ]);
        $comment = Comment::create([
            'body' => $request->body,
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id,
            'user_id' => auth()->id()
        ]);

        return back()->with('success', 'Reply on comment added successfully');
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->update(['body' => $request->body]);
        return redirect()->back()->with('success', 'Comment updated successfully');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}
