<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Login Admin
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials) && Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Kredensial salah atau Anda tidak memiliki akses admin.',
        ]);
    }

    // Login User
    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials) && Auth::user()->role == 'user') {
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'email' => 'Kredensial salah atau Anda tidak memiliki akses user.',
        ]);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
