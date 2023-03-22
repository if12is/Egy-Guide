<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function showUsers()
    {
        // Get the authenticated user
        $authUser = auth()->user();
        $authUserId = Auth::id();

        // Filter out the users that the authenticated user is already following
        $usersNotFollowed = User::whereNotIn('id', function ($query) use ($authUserId) {
            $query->select('following_id')
                ->from('user_relationships')
                ->where('follower_id', $authUserId);
        })->where('is_admin', '=', 0)
            ->where('id', '<>', $authUserId)
            ->orderBy('id', 'desc')
            ->get();


        return response()->json([
            'message' => 'Show users not following by ' . $authUser->name,
            'users' => $usersNotFollowed,
        ], 200);
    }


    public function store(User $user)
    {
        if (!auth()->user()->following->contains($user->id)) {
            auth()->user()->follow($user);

            return response()->json([
                'message' => 'You have followed ' . $user->name,
            ], 201);
        }

        return response()->json([
            'message' => 'You are already following ' . $user->name,
        ], 200);
    }

    
    public function destroy(User $user)
    {
        if (auth()->user()->following->contains($user->id)) {
            auth()->user()->unfollow($user);

            return response()->json([
                'message' => 'You have unfollow ' . $user->name,
            ], 200);
        }

        return response()->json([
            'message' => 'You are not following ' . $user->name,
        ], 200);

    }
}
