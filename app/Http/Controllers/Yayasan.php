<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Yayasan extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->level != 2) {
            return redirect()->intended('login');
        }
        echo "Ini Halaman Yayasan";
    }
}
