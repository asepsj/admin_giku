<?php

namespace App\Http\Controllers\Page\User;

use App\Models\User;
use App\Models\Klinik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DoctorsController extends Controller
{
    public function index(Request $request)
    {
        // Ambil nilai pencarian dari request
        $search = $request->input('table_search');

        // Jika ada nilai pencarian, filter data dokter
        if ($search) {
            $doctors = User::where('role', 'doctor')
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                ->paginate(5)
                ->appends(['table_search' => $search]); // Menambahkan parameter pencarian ke pagination
        } else {
            // Jika tidak ada nilai pencarian, ambil semua data dokter
            $doctors = User::where('role', 'doctor')->paginate(5);
        }

        // Kirim data dokter ke tampilan blade
        return view('pages.users.dokter.index', ['doctors' => $doctors]);
    }

    public function add(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'alamat' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20',
        ]);

        // Membuat user baru dengan peran dokter
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('12345678'), // Menggunakan hashing untuk password
            'role' => 'doctor',
            'alamat' => $request->alamat,
            'nomor_hp' => $request->nomor_hp,
        ]);

        // Jika role adalah doctor, tambahkan klinik
        if ($user->role == 'doctor') {
            Klinik::create([
                'user_id' => $user->id, // Menggunakan ID dokter yang baru dibuat
                'nama_klinik' => "Klinik Dr. " . $request->name, // Nama Klinik di-generate
                'alamat_klinik' => $request->alamat, // Menggunakan alamat dokter
                'deskripsi_klinik' => "Deskripsi otomatis untuk Klinik Dr. " . $request->name, // Deskripsi default
            ]);
        }

        return redirect()->route('doctors')->with('success', 'Doctor and Clinic created successfully.');
    }

    public function edit($id)
    {
        $doctor = User::findOrFail($id);
        return view('pages.users.dokter.edit', ['doctor' => $doctor]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'alamat' => 'nullable|string|max:255',
            'nomor_hp' => 'nullable|string|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $doctor = User::findOrFail($id);
            $doctor->name = $request->name;
            $doctor->email = $request->email;
            $doctor->alamat = $request->alamat;
            $doctor->nomor_hp = $request->nomor_hp;

            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($doctor->foto) {
                    Storage::delete('public/fotos/' . $doctor->foto);
                }

                // Simpan foto baru
                $imageName = time().'.'.$request->foto->extension();
                $request->foto->storeAs('public/fotos', $imageName);
                $doctor->foto = $imageName;
            }

            $doctor->save();

            return redirect()->route('doctors', $doctor->id)->with('success', 'Doctor updated successfully');
        } catch (\Exception $e) {
            // Jika ada error saat update, kembali ke halaman sebelumnya dengan pesan error
            return redirect()->back()->with('error', 'Failed to update doctor. Please try again.')->withInput();
        }
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
