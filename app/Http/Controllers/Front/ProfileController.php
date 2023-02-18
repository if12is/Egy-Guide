<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function index()
    // {
    //     $id = Auth::id();
    //     $user = User::find($id);
    //     return view('layouts.inc.front-navbar', compact('user'));
    // }

    public function edit($id)
    {
        $user = User::find($id);
        // $user = Auth::user();
        // return response()->json($id);
        if (empty($user->id)) {
            return redirect('/home');
        } else {
            if (Auth::user()->id == $user->id) {
                return view('front.myProfile', compact('user'));
            } else {
                // redirect user to home page
                return redirect('/home')->with('error', 'Not Allow For You');
            }
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            // 'avatar' => 'required',
        ]);
        $user->update(array_merge($request->except('user_id', 'avatar'), ['user_id' => Auth::user()->id]));
        // return response()->json($request->all());

        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatars');
            $user->addMediaFromRequest('avatar')
                ->toMediaCollection('avatars');
        }
        return redirect()->route('home.account-edit', $user->id)
            ->with('success', 'user Data updated successfully');
    }
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('home')
            ->with('success', 'U deleted successfully');
    }
}
