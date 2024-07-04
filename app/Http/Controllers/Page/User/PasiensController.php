<?php

namespace App\Http\Controllers\Page\User;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PasiensController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('table_search');

        $query = Pasien::query();

        if (!empty($search)) {
            $query->where('name_pasien', 'LIKE', "%{$search}%")
                ->orWhere('email_pasien', 'LIKE', "%{$search}%");
        }

        $pasiens = $query->paginate(5);

        return view('pages.users.pasien.index', ['pasiens' => $pasiens]);
    }

    public function edit($id)
    {
        // Ambil data pasien berdasarkan ID
        $pasien = Pasien::findOrFail($id);
        
        // Kirim data pasien ke tampilan edit
        return view('pages.users.pasien.edit', ['pasien' => $pasien]);
    }

    public function update(Request $request, $id)
{
    // Validasi data input
    $request->validate([
        'name_pasien' => 'required|string|max:255',
        'email_pasien' => 'required|string|email|max:255',
        'alamat' => 'nullable|string|max:255', // Tambahkan validasi untuk alamat
        'nomor_hp' => 'nullable|string|max:15', // Tambahkan validasi untuk nomor HP
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tambahkan validasi untuk foto (opsional)
    ]);

    // Cari pasien berdasarkan ID
    $pasien = Pasien::findOrFail($id);

    // Update data pasien
    $pasien->name_pasien = $request->input('name_pasien');
    $pasien->email_pasien = $request->input('email_pasien');
    $pasien->alamat = $request->input('alamat');
    $pasien->nomor_hp = $request->input('nomor_hp');

     // Mengelola unggahan foto jika ada
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($pasien->foto) {
            Storage::delete('public/fotos/' . $pasien->foto);
        }
        $foto = $request->file('foto');
        $namaFoto = time() . '.' . $foto->getClientOriginalExtension();
        $foto->storeAs('public/fotos', $namaFoto);

        $pasien->foto = $namaFoto;
    }

    $pasien->save();

    // Redirect ke halaman yang diinginkan setelah update
    return redirect()->route('pasiens')->with('success', 'Patient updated successfully');
}

    public function show($id)
    {
        // Temukan pasien berdasarkan ID
        $pasien = Pasien::findOrFail($id);
        
        // Kirim data pasien ke tampilan blade
        return view('pages.users.pasien.show', compact('pasien'));
    }

    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);

        $pasien->delete();

        return redirect()->route('pasiens')->with('success', 'Doctor deleted successfully.');
    }
}
