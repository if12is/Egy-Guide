<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return response()->json([
            'message' => 'Comment Created successfully',
            'comment' => $comment,
        ], 201);
    }

    public function store_reply(Request $request, Comment $comment)
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

        return response()->json([
            'message' => 'Reply on comment added successfully',
            'comment' => $comment,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if ($comment) {

            if ($comment && Auth::user()->id === $comment->user_id) {

                $comment->update(['body' => $request->body]);

                return response()->json([
                    'message' => 'Comment updated successfully',
                    'comment' => $comment,
                ], 200);
            }

            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        return response()->json([
            'message' => 'Comment not found'
        ], 404);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);

        if ($comment) {

            if ($comment && Auth::user()->id === $comment->user_id) {

                $comment->delete();

                return response()->json([
                    'message' => 'Comment deleted successfully',
                ], 200);
            }

            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        return response()->json([
            'message' => 'Comment not found'
        ], 404);
    }
}
