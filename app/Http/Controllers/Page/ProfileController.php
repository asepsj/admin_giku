<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // Get the currently authenticated user
        // $user = Auth::user();

        // Pass the user data to the view
        return view('dashboard.profile.profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'foto' => 'nullable|image|max:2048',
            'alamat' => 'nullable|string|max:255',
            'nomor_hp' => 'nullable|string|max:20',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/fotos');
            $user->foto = basename($path);
        }
        $user->alamat = $request->alamat;
        $user->nomor_hp = $request->nomor_hp;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}
