<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State;

class CountriesController extends Controller
{
    public function index()
    {
        $cities = State::where('country_id', 63)->get();
        // dd(count($cities));
        return view('front.city', compact('cities'));
    }



    public function showCityPosts($cityId)
    {

        $city = State::where('id', '=', $cityId)->get();
        // dd($city[0]->id);
        $posts = Post::where('state_id', '=', $cityId)->orderBy('state_id', 'desc')->paginate(5);
        return view('front.single-city', ['posts' => $posts, 'city' => $city]);
    }


}
