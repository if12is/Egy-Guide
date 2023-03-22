<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use WisdomDiala\Countrypkg\Models\Country;

class AdminPostController extends Controller
{
    public function index()
    {
        $users = User::get();
        $posts = Post::approved()->orderBy('id')->get();
        $categories = Category::all();
        $countries = Country::where('id', 63)->get();;
        return view('admin.posts', compact('posts', 'categories', 'countries', 'users'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.post-show', ['post' => $post]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'media' => 'required|file|mimes:jpeg,png,mp4|max:6048',
            'user_id' => 'required',
            'category_id' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
        ]);

        $allowed_video_types = array('video/mov', 'video/mp4', 'video/quicktime', 'video/avi');
        $allowed_image_types = array('image/jpeg', 'image/png');
        $file = $request->file('media');
        $mimeType = $file->getMimeType();

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'visible' => 1,
            'category_id' => $request->category_id,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
        ]);

        if ($request->hasFile('media') && $request->file('media')->isValid()) {
            if (in_array($mimeType, $allowed_video_types)) {
                $media = $post->addMediaFromRequest('media')
                    ->usingName($post->title)
                    ->toMediaCollection('videos');
            } elseif (in_array($mimeType, $allowed_image_types)) {
                $media = $post->addMediaFromRequest('media')
                    ->usingName($post->title)
                    ->toMediaCollection('images');
            } else {
                return back()->with('error', 'Invalid file type. Only MP4, OGG, MOV, JPG, JPEG , PNG and files are allowed.');
            }
        }

        return back()->with('success', 'Post created successfully');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $oldImage = $post->getMedia('images')->first(); // Get the old image item
        $oldVideo = $post->getMedia('videos')->first(); // Get the old video item
        $users = User::get();
        $countries = Country::where('id', 63)->get();
        $categories = Category::all();

        return view('admin.post-edit', compact('post', 'oldImage', 'oldVideo', 'countries', 'categories', 'users'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'media' => 'nullable|file|mimes:jpeg,png,mp4|max:6048',
            'user_id' => 'required',
            'category_id' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
        ]);
        $allowed_video_types = array('video/mov', 'video/mp4', 'video/quicktime', 'video/avi');
        $allowed_image_types = array('image/jpeg', 'image/png');

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $mimeType = $file->getMimeType();
        }


        if ($request->hasFile('media')) {
            if (in_array($mimeType, $allowed_video_types)) {
                $post->clearMediaCollection('videos')
                    ->clearMediaCollection('images')
                    ->addMediaFromRequest('media')
                    ->usingName($post->title)
                    ->toMediaCollection('videos');
            } elseif (in_array($mimeType, $allowed_image_types)) {
                $post->clearMediaCollection('images')
                    ->clearMediaCollection('videos')
                    ->addMediaFromRequest('media')
                    ->usingName($post->title)
                    ->toMediaCollection('images');
            } else {
                return back()->with('error', 'Invalid file type. Only MP4, OGG, MOV, JPG, JPEG , PNG and files are allowed.');
            }
        }

        $post->update(array_merge($request->except('user_id', 'media'), ['user_id' => $request->user_id]));


        return redirect()->route('admin.posts')
            ->with('success', 'Post updated successfully');
    }

    public function approved(Request $request, $id)
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
