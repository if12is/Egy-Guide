<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = User::find($id);
        $countries = Country::all();
        $posts = Post::orderBy('created_at', 'DESC')->get();
        $categories = Category::all();
        return view('front.home', compact('posts', 'countries', 'categories', 'user'));
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

    public function update(Request $request)
    {
        #validation
        return response($request()->all())->json();
        #Match old password

        #update password
    }
}
