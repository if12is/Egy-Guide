<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();

        return view('front.category', compact('categories'));
    }



    public function showCategoryPosts($categoryId)
    {

        $category = Category::with(['posts' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->find($categoryId);

        // dd($category);
        $posts = $category->posts()->paginate(5);
        return view('front.single-category', ['category' => $category, 'posts' => $posts]);
    }
}
