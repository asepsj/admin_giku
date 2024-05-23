<?php

namespace App\Http\Controllers\View;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasiensController extends Controller
{
    public function edit($id)
    {
        // Ambil data pasien berdasarkan ID
        $pasiens = Pasien::findOrFail($id);
        
        // Kirim data pasien ke tampilan edit
        return view('dashboard.pasien.edit_pasien', ['pasiens' => $pasiens]);
    }

    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'name_pasien' => 'required|string|max:255',
            'email_pasien' => 'required|string|email|max:255',
        ]);

        // Cari pasien berdasarkan ID dan update data
        $pasiens = Pasien::findOrFail($id);
        $pasiens->update([
            'name_pasien' => $request->input('name_pasien'),
            'email_pasien' => $request->input('email_pasien'),
        ]);

        // Redirect ke halaman yang diinginkan setelah update
        return redirect()->route('pasiens')->with('success', 'Patient updated successfully');
    }
}
