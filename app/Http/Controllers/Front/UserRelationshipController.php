<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRelationship;

class UserRelationshipController extends Controller
{
    // public function follow(User $user)
    // {
    //     if (auth()->user()->id === $user->id) {
    //         return back()->withErrors(['error' => 'You cannot follow yourself.']);
    //     }

    //     if (auth()->user()->following->contains($user)) {
    //         return back()->withErrors(['error' => 'You are already following this user.']);
    //     }

    //     auth()->user()->following()->attach($user);

    //     return back()->with(['success' => 'You are now following ' . $user->name]);
    // }

    // public function unfollow(User $user)
    // {

    //     auth()->user()->following()->detach($user);

    //     return back()->with(['success' => 'You have unfollowed ' . $user->name]);
    // }

    public function follow(Request $request, $id)
    {
        $user = User::find($id);
        $follower = $request->user();

        $follower->followers()->create([
            'followed_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'You have followed ' . $user->name);
    }

    public function unfollow(Request $request, $id)
    {
        $user = User::find($id);
        $follower = $request->user();

        $follower->followers()->where('followed_id', $user->id)->delete();

        return redirect()->back()->with('success', 'You have unfollowed ' . $user->name);
    }

    public function isFollowing($id)
    {
        return $this->following()->where('id', $id)->exists();
    }
}
