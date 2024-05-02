<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns|exists:users,email',
            'password' => 'required|min:8|max:20'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $authedUser = Auth::user();

            session()->put('level', $authedUser->level);

            if ($authedUser->level === 'admin') {
                return redirect()->intended('/admin/data-rw');
            }


            return redirect()->intended($authedUser->level);
        }

        return back()->with('error', 'Login gagal');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
