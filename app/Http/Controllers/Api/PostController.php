<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * getPostsFromFollowing
     */
    public function index(Request $request)
    {
        $followedAccounts = auth()->user()->following;

        // Check if the "followed" parameter is set
        if ($followedAccounts->count() > 0) {

            // Retrieve the posts that the user follows
            $posts = Post::whereHas('user', function ($query) use ($followedAccounts) {
                $query->whereIn('id', $followedAccounts->pluck('id'));
            })->orderBy('created_at', 'DESC')->get();
        } else {

            // Retrieve 10 random posts
            $posts = Post::inRandomOrder()->limit(10)->get();
        }

        return response()->json([
            // Load the comments and likes and media for each post
            'posts' => $posts->load('media', 'comments', 'reactions'),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'media' => 'required|file|mimes:jpeg,png,mp4|max:6048',
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
            'user_id' => Auth::user()->id,
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
                return response()->json(['error' => 'Invalid file type. Only MP4, OGG, MOV, JPG, JPEG , PNG and files are allowed.'], Response::HTTP_NOT_FOUND);
            }
        }
        return response()->json([
            'message' => 'Post Created successfully',
            'post' => $post->load('media'),
        ], 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], Response::HTTP_NOT_FOUND);
        }

        // Load the media for this post
        $media = $post->getMedia();


        // Load the comments and likes for this post
        $comments = $post->comments;
        $likes = $post->reactions;

        return response()->json([
            'post' => $post,
            'comments' => $comments,
            'likes' => $likes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'media' => 'nullable|file|mimes:jpeg,png,mp4|max:6048',
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

        if ($post && Auth::user()->id === $post->user_id) {

            $post->update(array_merge($request->except('user_id', 'media'), ['user_id' => Auth::user()->id]));

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
                    return response()->json(['error' => 'Invalid file type. Only MP4, OGG, MOV, JPG, JPEG , PNG and files are allowed.'], Response::HTTP_NOT_FOUND);
                }
            }
            return response()->json([
                'message' => 'Post updated successfully',
                'post' => $post
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post && Auth::user()->id === $post->user_id) {
            $post->delete();

            return response()->json([
                'message' => 'Post deleted successfully'
            ]);
        }

        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }
}
