<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function myprofile()
    {
        return view('front.myprofile');
    }
    public function setting()
    {
        return view('front.setting');
    }
    public function post()
    {
        return view('front.single-post');
    }
}
