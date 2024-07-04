<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('auth.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Jika autentikasi berhasil
            $request->session()->regenerate();

            // Tambahkan token ke pengguna
            $request->user()->createToken('API Token')->plainTextToken;

            // Arahkan ke dashboard
            return redirect()->intended('/dashboard')->with('success', 'Selamat datang! Anda berhasil masuk.');
        }

        // Jika autentikasi gagal
        return back()->withErrors([
            'email' => 'email atau password yang anda masukkan salah',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            // Hapus semua token pengguna
            auth()->user()->tokens()->delete();
        }
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
