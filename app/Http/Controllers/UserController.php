<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admins.pages.users.index', compact('users'));

        // Eager load roles with users
         $users = User::with('roles')->get();
         
        // Return the view with the users data
         return view('admins.pages.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admins.pages.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // add validation rules for roles if needed
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
    
}