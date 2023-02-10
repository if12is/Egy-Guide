<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State;

class CountriesController extends Controller
{
    public function getAllCountries()
    {
        // $countries = Country::get();
        // $states = State::all();
        // // dd($countries);
        // return response()->json($countries);
        // return view('front.home', compact('countries', 'states'));
    }
}
