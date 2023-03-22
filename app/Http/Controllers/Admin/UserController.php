<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id')->get();
        return view('admin.user', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'avatar' => 'image|max:2048' // max 2MB
        ]);
        // dd($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->hasFile('avatar')) {
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }

        return back()->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $oldImage = $user->getMedia('avatars')->first(); // Get the old image item
        return view('admin.user-edit', compact('user', 'oldImage'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'avatar' => 'image|max:2048' // max 2MB
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatars');
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }

        return redirect()->route('admin.users')->with('success', 'User update successfully ' . $user->name);
    }

    public function destroy(User $user)
    {
        // Delete the category's media items
        $user->clearMediaCollection('avatars');

        // Delete the user
        $user->delete();

        return back()->with('success', 'User deleted successfully ' . $user->name);
    }
}
