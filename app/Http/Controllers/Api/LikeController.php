<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Qirolab\Laravel\Reactions\Models\Reaction;

class LikeController extends Controller
{

    public function addReaction($id)
    {

        $post = Post::find($id);

        $user_id = Auth::id();

        // Check if the user has already liked the post
        $is_liked = Reaction::where('user_id', $user_id)
            ->where('reactable_id', $id)
            ->where('type', 'like')
            ->exists();
        if ($post) {
            if (!$is_liked) {
                $reaction = $post->react('like', auth()->user());
                
                $reactions_count = count($post->reactions);
                return response()->json([
                    'message' => 'Reaction Add successfully',
                    'reaction count' => $reactions_count,
                    'reaction' => $reaction,
                    'types' => $post->reaction_summary,
                ], 200);
            }
            return response()->json([
                'message' => 'Reaction already exist on the post',
            ], 200);
        }

        return response()->json([
            'message' => 'Post Not found',
        ], 404);
    }

    public function removeReaction($id)
    {

        $post = Post::find($id);

        $user_id = Auth::id();

        // Check if the user has already liked the post
        $is_liked = Reaction::where('user_id', $user_id)
            ->where('reactable_id', $id)
            ->where('type', 'like')
            ->exists();

        if ($post) {
            if ($is_liked) {
                $post->removeReaction(auth()->user());
                return response()->json([
                    'message' => 'Reaction Removed successfully',
                ], 200);
            }
            return response()->json([
                'message' => 'No Reaction exist on this post',
            ], 200);
        }

        return response()->json([
            'message' => 'Post Not found',
        ], 404);
    }
    function getReactions($id)
    {
        $post = Post::find($id);
        if ($post) {
            $reactions_count = count($post->reactions);
            return response()->json([
                'message' => 'Get all reactions on post ' . $post->id,
                'reactions count' => $reactions_count,
                'reactions' => $post->reaction_summary,
            ], 200);
        }
        return response()->json([
            'message' => 'Post Not found',
        ], 404);
    }
}
