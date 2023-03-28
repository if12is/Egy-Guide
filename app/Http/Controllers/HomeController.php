<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Qirolab\Laravel\Reactions\Models\Reaction;
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

        if (count($followedAccounts) > 0) {
            $posts = Post::whereHas('user', function ($query) use ($followedAccounts) {
                $query->whereIn('id', $followedAccounts->pluck('id'));
            })->orderBy('created_at', 'DESC')->paginate(5);
        } else {
            $posts = Post::inRandomOrder()->limit(10)->orderBy('created_at', 'DESC')->get();
        }

        $categories = Category::all();

        $topUsers = User::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->where('users.is_admin', 0)
            ->take(10)
            ->get();


        $count = 1;
        return view('front.home', compact('posts', 'countries', 'usersNotFollowed', 'categories', 'user', 'topUsers', 'count'));
    }
    public function getPosts()
    {
        $followedAccounts = auth()->user()->following;

        $posts = Post::whereHas('user', function ($query) use ($followedAccounts) {
            $query->whereIn('id', $followedAccounts->pluck('id'));
        })->orderBy('created_at', 'DESC')->paginate(5);

        return response()->json($posts);
    }


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

    public function updateToken(Request $request)
    {
        try {
            $request->user()->update(['fcm_token' => $request->token]);
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'success' => false
            ], 500);
        }
    }


    // public function getPostsByCategory($id)
    // {
    //     $posts = Post::where('category_id', $id)->orderBy('created_at', 'DESC')->paginate(5);
    //     return response()->json($posts);
    // }
    // public function getPostsByUser($id)
    // {
    //     $posts = Post::where('user_id', $id)->orderBy('created_at', 'DESC')->paginate(5);
    //     return response()->json($posts);
    // }
    // public function getPostsBySearch($search)
    // {
    //     $posts = Post::where('title', 'like', '%' . $search . '%')->orderBy('created_at', 'DESC')->paginate(5);
    //     return response()->json($posts);
    // }
    // public function getComments($id)
    // {
    //     $comments = Comment::where('post_id', $id)->orderBy('created_at', 'DESC')->get();
    //     return response()->json($comments);
    // }
    // // Get average runtime of successful runs in seconds
    // public function getAverageRuntime()
    // {
    //     $averageRuntime = DB::table('runs')
    //         ->where('status', 'success')
    //         ->avg('runtime');
    //     return response()->json($averageRuntime);
    // }
    // // make controller to get all reactions on post
    // public function getReactions($id)
    // {
    //     $reactions = Reaction::where('post_id', $id)->orderBy('created_at', 'DESC')->get();
    //     return response()->json($reactions);
    // }
    // // make controller to get all reactions on post
    // public function getReactionsCount($id)
    // {
    //     $reactions = Reaction::where('post_id', $id)->orderBy('created_at', 'DESC')->get();
    //     return response()->json($reactions);
    // }
}
