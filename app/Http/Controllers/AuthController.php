<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'Registration successful! Please log in.');
    }

public function login(Request $request){
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $remember = $request->has('remember');

    if (Auth::attempt($credentials, $remember)) {
        // Debug before regenerate
        $oldSessionId = session()->getId();

        $request->session()->regenerate();

        // Debug after regenerate
        $newSessionId = session()->getId();

        \Log::info('Login session debug', [
            'old_session_id' => $oldSessionId,
            'new_session_id' => $newSessionId,
            'user_id' => Auth::id(),
            'session_data' => session()->all()
        ]);

        // Force save session
        session()->save();

        return redirect()->intended('/profile')->with('success', 'Welcome back!');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
}

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logged out successfully!');
    }
}
