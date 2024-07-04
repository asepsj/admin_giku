<?php

namespace App\Http\Controllers\Page\Profile;

use App\Models\Klinik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyprofileController extends Controller
{
    public function index()
    {
        $klinik = Klinik::where('user_id', Auth::user()->id)->first();
        return view('pages.profile.myprofile.index', compact('klinik'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'foto' => 'nullable|image|max:2048',
            'alamat' => 'nullable|string|max:255',
            'nomor_hp' => 'nullable|string|max:20',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                Storage::delete('public/fotos/' . $user->foto);
            }
            // Simpan foto baru
            $imageName = time().'.'.$request->foto->extension();
            $request->foto->storeAs('public/fotos', $imageName);
            $user->foto = $imageName;
        }
        $user->alamat = $request->alamat;
        $user->nomor_hp = $request->nomor_hp;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}
