<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     *
     *  User Information
     *
     */
    public function user()
    {
        return response([
            'user' => Auth::user()
        ], 200);
    }
    /**
     *
     *  User Edit name and email , Upload image
     *
     */

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $request->user()->id,
            'avatar' => 'image|max:2048',
        ]);

        $user = $request->user();

        $name = $request->has('name') ? $request->name : $user->name;
        $email = $request->has('email') ? $request->email : $user->email;

        $user->update([
            'name' => $name,
            'email' => $email,
        ]);

        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatars');
            $user->addMediaFromRequest('avatar')
                ->toMediaCollection('avatars');
        }

        return response()->json([
            'message' => 'User details updated successfully',
            'user' => $user->load('media'),
        ], 200);
    }

    /**
     *
     *  User Delete account
     *
     */
    public function delete(Request $request)
    {
        $request->user()->tokens()->delete();
        $request->user()->delete();

        return response()->json([
            'message' => 'Account deleted successfully',
        ], 200);
    }
}
