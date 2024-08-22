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

        return redirect()->route('users.index.admin')->with('success', 'User created successfully.');
    }

    // Update an existing user

    public function updateUser(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'role' => 'required|exists:roles,id', // Validate role input
    ]);

    // Update user details
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->role_id = $request->input('role'); // Ensure role_id is updated
    $user->save();

    // Redirect with success message
    return redirect()->route('users.index.admin')->with('success', 'User updated successfully.');
}
    // Delete a user
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index.admin')->with('success', 'User deleted successfully.');
    }
}
