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


        // dd($topUsers);
        $user = User::find($id);
        $countries = Country::all();;
        $posts = Post::orderBy('created_at', 'DESC')->paginate(5);
        // $comments = Comment::get();
        // dd($comments);
        $categories = Category::all();

        $topUsers = User::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->where('users.is_admin', 0)
            ->take(10)
            ->get();

        // $topUsers = User::select('users.name', 'posts.user_id', DB::raw('COUNT(*) as count'))
        //     ->join('posts', 'posts.user_id', '=', 'users.id')
        //     ->where('users.is_admin', 0)
        //     ->groupBy('posts.user_id')
        //     ->orderBy('count', 'desc')
        //     ->take(10)
        //     ->get();
        // dd($topUsers);
        $count = 1;
        return view('front.home', compact('posts', 'countries', 'categories', 'user', 'topUsers', 'count'));
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

    public function update(Request $request)

    public function update(Request $request)
    {
        #validation
        return response($request()->all())->json();
        #Match old password

        #update password
        #validation
        return response($request()->all())->json();
        #Match old password

        #update password
    }
}
