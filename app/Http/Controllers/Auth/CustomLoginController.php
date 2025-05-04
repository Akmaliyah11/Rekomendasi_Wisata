<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $loginAs = $request->input('login_as'); // ambil role dari form

        if (Auth::attempt(array_merge($credentials, ['role' => $loginAs]))) {
            $request->session()->regenerate();

            if ($loginAs === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/user/home');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah, atau role tidak sesuai.',
        ])->withInput($request->only('email'));
    }
}
