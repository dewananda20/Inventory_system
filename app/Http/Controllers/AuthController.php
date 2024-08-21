<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $login = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($login)) {
            if (Auth::user()->role_id == 1) {
                return redirect('/admin-dashboard');
            } else if (Auth::user()->role_id == 2) {
                return redirect('/staff-dashboard');
            }
        } else {
            return redirect('/')->with('error', 'Invalid credentials, please check your username and password.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
