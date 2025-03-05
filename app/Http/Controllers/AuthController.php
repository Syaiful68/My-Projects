<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (auth()->check()) {
            $userRole = Auth::user()->rules;
            if ($userRole === 'admin') {
                return redirect('/');
            }
            return redirect('/fuel');
        }
        return Inertia::render('login');
    }

    public function Authentication(Request $request)
    {
        $credentials = $request->validate([
            'user' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $userRole = Auth::user()->rules;
            if ($userRole === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
            $request->session()->regenerate();
            return redirect()->intended('/fuel');
        }
        return redirect('/login')->with('error', 'User and Password no match ');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
