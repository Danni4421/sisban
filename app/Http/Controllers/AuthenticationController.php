<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make(
            request()->all(),
            rules: [
                'username' => 'required|exists:users,username',
                'password' => 'required|min:8|max:20'
            ],
            messages: [
                'username.required' => 'Wajib untuk mengisi Email.',
                'username.exists' => 'Username tidak ditemukan.',
                'password.required' => 'Wajib untuk mengisi Password.',
                'password.min' => 'Minimal password harus 8 karakter.',
                'password.max' => 'Maximal password harus 20 karakter.'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            $authedUser = Auth::user();

            session()->put('level', $authedUser->level);

            if ($authedUser->level === 'admin') {
                return redirect()->intended('/admin/data-rw');
            } else if($authedUser->level === 'warga') {
                return redirect()->intended('/');
            }

            return redirect()->intended($authedUser->level);
        }

        return redirect()->to('login')->with('error', 'Login gagal');
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect()->to('/login');
    }
}
