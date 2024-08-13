<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan token dari session
        $uid = $request->session()->get('uid');

        if ($uid) {
            return redirect()->intended('/dashboard');
        } else {
            return view('auth.login.index');
        }
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $firebaseAuth = Firebase::auth();

        try {
            $signInResult = $firebaseAuth->signInWithEmailAndPassword($request->email, $request->password);
            $request->session()->put('uid', $signInResult->firebaseUserId());

            return redirect()->intended('/dashboard')->with('success', 'Selamat datang! Anda berhasil masuk.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Login gagal: ' . $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->remove('uid');
        $cookie = Cookie::forget('uid');
        return redirect()->route('login')->with('success', 'Anda berhasil keluar.')->withCookie($cookie);
    }
}
