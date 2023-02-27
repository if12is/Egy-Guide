<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();


        // Filter out the users that the authenticated user is already following
        $usersNotFollowed = User::whereNotIn('id', function ($query) use ($id) {
            $query->select('following_id')
                ->from('user_relationships')
                ->where('follower_id', $id);
        })->where('is_admin', '=', 0)
            ->where('id', '<>', $id)
            ->orderBy('id', 'desc')
            ->paginate(6);
        // dd($usersNotFollowed);

        $user = User::find($id);
        $countries = Country::where('id', 63)->get();;

        $followedAccounts = auth()->user()->following;

        $posts = Post::whereHas('user', function ($query) use ($followedAccounts) {
            $query->whereIn('id', $followedAccounts->pluck('id'));
        })->orderBy('created_at', 'DESC')->paginate(5);

        $posts_not_follow_yet = Post::inRandomOrder()->limit(10)->get();
        // dd($posts_not_follow_yet);

        $categories = Category::all();

        $topUsers = User::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->where('users.is_admin', 0)
            ->take(10)
            ->get();


        $count = 1;
        return view('front.home', compact('posts', 'posts_not_follow_yet', 'countries', 'usersNotFollowed', 'categories', 'user', 'topUsers', 'count'));
    }

    // public function show_comment($id)
    // {
    //     $post = Post::findOrFail($id);
    //     $comments = $post->comments()->with('user')->whereNull('parent_id')->get();

    //     return view('front.home', compact('comments'));
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
