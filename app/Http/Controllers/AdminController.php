<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Display users
    public function showUsers()
    {
        $users = User::with('roles')->get(); // Fetch users with their roles
        $roles = Role::all(); // Fetch all roles

        return view('admins.pages.user', compact('users', 'roles'));
    }

    // Show the form for creating a new user
    public function createUser()
    {
        $roles = Role::all(); // Fetch all roles
        return view('admins.pages.createuser', compact('roles'));
    }

    // Store a newly created user in the database
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required',  // Changed from 'required|array'
        ]);

        $user = User::create($request->only('name', 'email'));

        // Attach the role (single role handling)
        $user->roles()->sync([$request->input('role')]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->role_id = $request->input('role');
        $user->save();
        
        return redirect()->route('admins.pages.user');
    }
    // Delete a user
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
