<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function showCategories()
    {
        $categories = Category::get();
        $categories_count = count($categories);
        return response()->json([
            'message' => 'Get All category ',
            'categories_count' => $categories_count,
            'categories' => $categories,
        ], 200);
    }

    public function showCategoryPosts($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category_posts = Category::with(['posts' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])->withCount('posts')
                ->find($id);

            return response()->json([
                'message' => 'Get All posts of category ' . $category_posts->name,
                'category' => $category_posts,
            ], 200);
        }
        return response()->json([
            'message' => 'Category not found',
        ], 404);
    }
}
