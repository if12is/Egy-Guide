<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function index()
    // {
    //     $posts = Post::latest()->get();
    //     return view('posts.index', compact('posts'));
    // }

    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function create()
    // {
    //     return view('posts.create');
    // }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {


        $validator = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'category_id' => "required",
            'country_id' => 'required',
            'state_id' => 'required',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
        ]);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $post->addMediaFromRequest('image')
                ->usingName($post->title)
                ->toMediaCollection('images');
        }

        return redirect()->route('home');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $user = Auth::user();
        $countries = Country::all();
        $categories = Category::all();
        if (empty($post->user->id)) {
            return redirect()->route('home');
        }
        if (Auth::user()->id == $post->user->id) {
            return view('front.post-edit', compact('post', 'countries', 'categories', 'user'));
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
            'image' => 'required',
            'category_id' => "required",
            'country_id' => 'required',
            'state_id' => 'required',
        ]);

        $post->update(array_merge($request->except('user_id', 'image'), ['user_id' => Auth::user()->id]));

        if ($request->hasFile('image')) {
            $post->clearMediaCollection('images');
            $post->addMediaFromRequest('image')
                ->toMediaCollection('images');
        }

        return redirect()->route('home')
            ->with('success', 'Post updated successfully');
    }

    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->route('home')
            ->with('success', 'Post deleted successfully');
    }

    // public function test()
    // {
    //     $posts = Post::with('media')->get();
    //     return response()->json($posts);
    // }
    public function getStates()
    {
        $country_id = request('country');
        $states = State::where('country_id', $country_id)->get();
        $option = "<option value=''>Select State</option>";
        foreach ($states as $state) {
            $option .= '<option value="' . $state->id . '">' . $state->name . '</option>';
        }
        return $option;
    }
}
