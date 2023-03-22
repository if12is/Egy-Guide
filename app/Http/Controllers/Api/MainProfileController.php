<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bio;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainProfileController extends Controller
{
    public function show($id)
    {
        $user = User::withCount('posts')->find($id);
        if ($user) {
            // Get user bio info
            $userbio = DB::table('bios')->where('user_id', $id)->first();
            // get posts of user
            $posts = $user->posts()->where('user_id', $id)->get();
            // get count of posts
            $postCount = $user->posts_count;
            // get the count of followers
            $followers = $user->followers()->count();
            // get the count of following
            $following = $user->following()->count();
            // joined at
            $joined_at = $user->created_at->format('M  Y');
            // get dob of user
            $dob = DB::table('bios')->where('user_id', $id)->value('dob');
            $result = $dob ? $dob : 'NULL';
            // if is not valid return nothing if data is valid calc the age
            if ($result === 'NULL') {
                $years = 'NULL';
            } else {
                $dateOfBirth = $user->bio->dob;
                $years = Carbon::parse($dateOfBirth)->age;
            }
            return response()->json([
                'message' => 'Get All info for' . $user->name,
                'posts' => $posts,
                'post count' => $postCount,
                'bio' => ['data' => $userbio, 'years' => $years, 'Joined at' => $joined_at],
                'followers number' => $followers,
                'following number' => $following,
            ], 200);
        }
        return response()->json([
            'message' => 'User not found',
        ], 404);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'extra_email' => 'email',
        ]);

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

        // get dob of user
        $dob = DB::table('bios')->where('user_id', $user->id)->value('dob');
        $result = $dob ? $dob : 'NULL';
        // if is not valid return nothing if data is valid calc the age
        if ($result === 'NULL') {
            $years = 'NULL';
        } else {
            $dateOfBirth = $user->bio->dob;
            $years = Carbon::parse($dateOfBirth)->age;
        }
        return response()->json([
            'message' => 'Information updated successfully',
            'info' => $bio,
            "years" => $years,
        ], 201);
    }
}
