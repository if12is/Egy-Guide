<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Bio;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = Auth::id();
        // $user = User::find($id);
        $user = User::withCount('posts')->find($id);
        $postCount = $user->posts_count;

        // check if data is valid or not
        $bio = $user->bio;

        // $posts = $user->posts;
        $posts = $user->posts()->where('user_id', $id)->get();

        $dob = DB::table('bios')->where('user_id', $id)->value('dob');
        $result = $dob ? $dob : 'NULL';

        // if is not valid return nothing if data is valid calc the age
        if ($result === 'NULL') {
            $years = 'NULL';
        } else {
            $dateOfBirth = $user->bio->dob;
            $years = Carbon::parse($dateOfBirth)->age;
        }


        return view('front.profile', compact('user', 'years', 'bio', 'posts'));
    }

    public function show($id)
    {
        $user = User::withCount('posts')->find($id);
        $postCount = $user->posts_count;

        // check if data is valid or not
        $bio = $user->bio;

        // $user_profile = $id;
        // $user_profile_id = intval($id);
        // dd($user_profile_id);
        // $posts = $user->posts;
        $posts = $user->posts()->where('user_id', $id)->get();

        $dob = DB::table('bios')->where('user_id', $id)->value('dob');
        $result = $dob ? $dob : 'NULL';
        // if is not valid return nothing if data is valid calc the age
        if ($result === 'NULL') {
            $years = 'NULL';
        } else {
            $dateOfBirth = $user->bio->dob;
            $years = Carbon::parse($dateOfBirth)->age;
        }
        // // dd($years);
        return view('front.profile', compact('user', 'years', 'bio', 'posts'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'extra_email' => 'email',
        ]);
        // dd($request->all());

        $bio = Bio::updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'dob' => $request->dob,
                'job' => $request->job,
                'contact_number' => $request->contact_number,
                'extra_email' => $request->extra_email,
                'country' => $request->country,
                'city' => $request->city,
            ]
        );
        return redirect()->back()->with('success', 'Bio updated successfully.');
    }

    public function connections()
    {
        $id = Auth::id();
        $user = User::find($id);
        return view('front.connections', compact('user'));
    }
}
