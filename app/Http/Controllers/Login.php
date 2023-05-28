<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->level == 1) {
                return redirect()->intended('admin');
            } elseif ($user->level == 1) {
                return redirect()->intended('yayasan');
            }
        }

        return view('login');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $kredensial = $request->only('username', 'password');
        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->level == 1) {
                return redirect()->intended('admin');
            } elseif ($user->level == 2) {
                return redirect()->intended('yayasan');
            }

            return redirect()->intended('login');
        }


        return back()->withErrors(['gagal' => "Maaf Username atau Password anda salah",])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
