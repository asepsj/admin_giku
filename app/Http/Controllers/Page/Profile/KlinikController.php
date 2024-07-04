<?php

namespace App\Http\Controllers\Page\Profile;

use App\Models\Klinik;
use App\Models\KlinikPhotos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KlinikController extends Controller
{
    public function index($id)
    {
        $user = Auth::user();
    
        if ($user->role === 'doctor') {
            // Jika user adalah dokter, cari klinik berdasarkan user_id dokter
            $klinik = Klinik::where('user_id', $user->id)->firstOrFail();
        } elseif ($user->role === 'admin') {
            // Jika user adalah admin, cari klinik berdasarkan id dokter dari URL
            $klinik = Klinik::where('user_id', $id)->firstOrFail();
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        return view('pages.profile.klinik.index', compact('klinik'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            return redirect()->route('klinik', $id);
        }
        
        $klinik = Klinik::where('user_id', $user->id)->firstOrFail();

        return view('pages.klinik.edit', compact('klinik'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $klinik = $user->klinik;

        if (!$klinik) {
            return redirect()->route('klinik')->with('error', 'Tidak ada klinik yang terhubung dengan pengguna.');
        }

        $request->validate([
            'nama_klinik' => 'required|string|max:255',
            'alamat_klinik' => 'required|string|max:255',
            'deskripsi_klinik' => 'nullable|string',
            'foto_klinik.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $klinik->nama_klinik = $request->nama_klinik;
        $klinik->alamat_klinik = $request->alamat_klinik;
        $klinik->deskripsi_klinik = $request->deskripsi_klinik;
        $klinik->save();

        $existingPhotosCount = $klinik->photos()->count();
        $uploadedPhotosCount = $request->hasFile('foto_klinik') ? count($request->file('foto_klinik')) : 0;
        $totalPhotosCount = $existingPhotosCount + $uploadedPhotosCount;

        if ($totalPhotosCount > 5) {
            return redirect()->route('klinik.edit', ['id' => $klinik->id])
                            ->with('error', 'Maksimal 5 foto yang diperbolehkan.');
        }

        if ($request->hasFile('foto_klinik')) {
            foreach ($request->file('foto_klinik') as $photo) {
                $fileName = time() . '_' . $photo->getClientOriginalName();
                $photo->storeAs('public/fotos', $fileName);

                KlinikPhotos::create([
                    'klinik_id' => $klinik->id,
                    'photo_path' => $fileName,
                ]);
            }
        }

        return redirect()->route('klinik', ['id' => Auth::user()->id])->with('success', 'Klinik berhasil diperbarui.');
    }

    public function editPhotos($id)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $klinik = Klinik::findOrFail($id);
        } else {
            $klinik = Klinik::where('user_id', $user->id)->firstOrFail();
        }

        return view('pages.profile.klinik.editfoto.index', compact('klinik'));
    }

    public function updatePhotos(Request $request, $id)
    {
        $user = Auth::user();
        $klinik = Klinik::findOrFail($id);

        if ($user->role !== 'admin' && $klinik->user_id !== $user->id) {
            return redirect()->route('klinik')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'foto_klinik.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto_klinik')) {
            foreach ($request->file('foto_klinik') as $photo) {
                $fileName = time() . '_' . $photo->getClientOriginalName();
                $photo->storeAs('public/fotos', $fileName);

                KlinikPhotos::create([
                    'klinik_id' => $klinik->id,
                    'photo_path' => $fileName,
                ]);
            }
        }

        return redirect()->route('kliniks.editPhotos', $id)->with('success', 'Photos updated successfully.');
    }

    public function deletePhoto($id)
    {
        $photo = KlinikPhotos::findOrFail($id);
        Storage::delete('public/fotos/' . $photo->photo_path);
        $photo->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }
}
