<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State;
use Qirolab\Laravel\Reactions\Facades\Reactions;
use Qirolab\Laravel\Reactions\Models\Reaction;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function more(Request $request)
    {
        $last_post_id = $request->last_post_id;


        $followedAccounts = auth()->user()->following;
        $user = Auth::user();

        if ($user) {
            $following = $user->following->pluck('id');
            $posts = Post::whereIn('user_id', $following)
                ->where('id', '<', $last_post_id)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        } else {
            $posts = Post::where('id', '<', $last_post_id)
                ->inRandomOrder()
                ->limit(10)
                ->get();
        }

        if ($posts->isEmpty()) {
            return response()->json([
                'html' => '',
                'message' => 'No more posts to display follow to show more ....'
            ]);
        }

        return response()->json([
            'html' => view('front.posts', compact('posts'))->render()
        ]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('front.single-post', ['post' => $post]);
    }


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
                return redirect()->route('home')->with('error', 'Invalid file type. Only MP4, OGG, MOV, JPG, JPEG , PNG and files are allowed.');
            }
        }

        return redirect()->route('home')->with('success', 'Post created successfully');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $oldImage = $post->getMedia('images')->first(); // Get the old image item
        $oldVideo = $post->getMedia('videos')->first(); // Get the old video item
        $user = Auth::user();
        $countries = Country::where('id', 63)->get();
        $categories = Category::all();

        if (empty($post->user->id)) {
            return redirect()->route('home');
        }
        if (Auth::user()->id == $post->user->id) {
            return view('front.post-edit', compact('post', 'oldImage', 'oldVideo', 'countries', 'categories', 'user'));
        } else {
            // redirect user to home page
            return redirect('/home')->with('error', 'Not Allow For You To Edit Anther Posts');
        }
    }

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
                return redirect()->route('home')->with('error', 'Invalid file type. Only MP4, OGG, MOV, JPG, JPEG , PNG and files are allowed.');
            }
        }

        $post->update(array_merge($request->except('user_id', 'media'), ['user_id' => Auth::user()->id]));


        return redirect()->route('home')
            ->with('success', 'Post updated successfully');
    }

    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->route('home')
            ->with('success', 'Post deleted successfully');
    }


    public function getStates($country)
    {
        $states = State::where('country_id', $country)->get();

        return response()->json($states);
    }

    public function getPosts(Request $request)
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(5);
        return response()->json([
            'posts' => view('posts', ['posts' => $posts])->render()
        ]);
    }

    public function addReaction(Request $request)
    {
        $postId = $request->input('post_id');
        $reactionName = $request->input('reaction');

        $post = Post::find($postId);
        $post->toggleReaction('like', auth()->user());

        $user_id = Auth::id();
        // Check if the user has already liked the post
        $is_liked = Reaction::where('user_id', $user_id)
            ->where('reactable_id', $postId)
            ->where('type', 'like')
            ->exists();


        $reactionCount = $post->reactions()->count();

        return response()->json([
            'count' => $reactionCount,
            'is_liked' => $is_liked
        ]);
    }


    public function search(Request $request)
    {
        // Get the search query from the user
        $searchQuery = $request->input('search');

        // Retrieve the posts from the database based on the search query

        $posts = Post::with('user', 'country', 'category', 'state')
            ->where('title', 'like', "%$searchQuery%")
            ->orWhere('description', 'like', "%$searchQuery%")
            ->orWhereRelation('user', 'name', 'like', '%' . $searchQuery . '%')
            ->orWhereRelation('country', 'name', 'like', '%' . $searchQuery . '%')
            ->orWhereRelation('category', 'name', 'like', '%' . $searchQuery . '%')
            ->orWhereRelation('state', 'name', 'like', '%' . $searchQuery . '%')
            ->get();

        // Display the search results
        return view('front.search', ['posts' => $posts, 'query' => $searchQuery]);
    }
}
