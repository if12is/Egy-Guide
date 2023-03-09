<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::approved()->orderBy('id')->get();
        return view('admin.posts', compact('posts'));
    }
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post->update(['visible' => 1]);

        return back()->with('success', 'post successfully approved');
    }

    public function destroy($id)
    {
        Post::find($id)->delete();
        return back()->with('success', 'Post deleted successfully');
    }
}
