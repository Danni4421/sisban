<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\User;
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
        $validator = Validator::make(request()->all(), 
            rules: [
                'email' => 'required|email:dns|exists:users,email',
                'password' => 'required|min:8|max:20'
            ],
            messages: [
                'email.required' => 'Wajib untuk mengisi Email.',
                'email.email' => 'Email tidak valid.',
                'email.exists' => 'Email tidak valid.',
                'password.required' => 'Wajib untuk mengisi Password.',
                'password.min' => 'Minimal password harus 8 karakter.',
                'password.max' => 'Maximal password harus 20 karakter.'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $authedUser = Auth::user();

            session()->put('level', $authedUser->level);

            if ($authedUser->level === 'admin') {
                return redirect()->intended('/admin/data-rw');
            }

            return redirect()->intended($authedUser->level);
        }

        return redirect()->to('login')->with('error', 'Login gagal.');
    }
}
