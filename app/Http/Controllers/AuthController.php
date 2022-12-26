<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function loginAdmin() {
        if (auth()->attempt(['username' => request()->username, 'password' => request('password')])) {
            if (auth()->user()->role == 'pegawai') {
                return redirect()->route('request-kendaraan');
            }
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Username atau Password Salah');
        }
    }

    public function logout() {
        auth()->logout();
        return redirect()->route('user.login');
    }
}
