<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRelationship;
use Illuminate\Support\Facades\Auth;

class UserRelationshipController extends Controller
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
            ->paginate(6);


        // dd($usersNotFollowed);
        return view('front.connections', [
            'users' => $usersNotFollowed,
            'user' => $authUser
        ]);
    }


    public function store(User $user)
    {
        auth()->user()->follow($user);

        return back()->with('success', 'You have followed ' . $user->name);
    }

    public function destroy(User $user)
    {
        auth()->user()->unfollow($user);

        return back()->with('success', 'You have unfollowed ' . $user->name);
    }
}
