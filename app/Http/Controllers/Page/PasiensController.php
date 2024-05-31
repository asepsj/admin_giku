<?php

namespace App\Http\Controllers\Page;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasiensController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->input('table_search');

        $query = Pasien::query();

        if (!empty($search)) {
            $query->where('name_pasien', 'LIKE', "%{$search}%")
                ->orWhere('email_pasien', 'LIKE', "%{$search}%");
        }

        $pasiens = $query->paginate(5);

        return view('dashboard.pasien.pasiens', ['pasiens' => $pasiens]);
    }

    public function edit($id)
    {
        // Ambil data pasien berdasarkan ID
        $pasiens = Pasien::findOrFail($id);
        
        // Kirim data pasien ke tampilan edit
        return view('dashboard.pasien.edit', ['pasiens' => $pasiens]);
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

    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);

        $pasien->delete();

        return redirect()->route('pasiens')->with('success', 'Doctor deleted successfully.');
    }
}
