<?php

namespace App\Http\Controllers\View;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
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

    public function addDoctors(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => '12345678',
            'role' => 'doctor',
            'foto' => $request->foto,
            'alamat' => $request->alamat,
            'nomor_hp' => $request->nomor_hp,
        ]);

        return redirect()->route('doctors')->with('success', 'Doctor created successfully.');
    }

    public function destroy($id)
    {
        $doctor = User::findOrFail($id);

        if ($doctor->role !== 'doctor') {
            return redirect()->route('doctors')->with('error', 'User is not a doctor.');
        }

        $doctor->delete();

        return redirect()->route('doctors')->with('success', 'Doctor deleted successfully.');
    }
}
