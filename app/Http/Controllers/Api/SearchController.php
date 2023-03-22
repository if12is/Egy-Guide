<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search($search)
    {
        // Get the search query from the user
        $searchQuery = $search;

        // Retrieve the posts from the database based on the search query

        $posts = Post::with('user', 'country', 'category', 'state')
            ->where('title', 'like', "%$searchQuery%")
            ->orWhere('description', 'like', "%$searchQuery%")
            ->orWhereRelation('user', 'name', 'like', '%' . $searchQuery . '%')
            ->orWhereRelation('country', 'name', 'like', '%' . $searchQuery . '%')
            ->orWhereRelation('category', 'name', 'like', '%' . $searchQuery . '%')
            ->orWhereRelation('state', 'name', 'like', '%' . $searchQuery . '%')
            ->get();

        if ($posts) {
            return response()->json([
                'message' => 'Get All posts that contain ' . $searchQuery,
                'posts' => $posts->load('media', 'comments', 'reactions'),
            ], 200);
        }
        return response()->json([
            'message' => 'Not found posts contain ' . $searchQuery,
        ], 404);
    }
}
