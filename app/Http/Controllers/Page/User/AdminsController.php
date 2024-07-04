<?php

namespace App\Http\Controllers\Page\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminsController extends Controller
{
    public function index(Request $request)
    {
        // Ambil nilai pencarian dari request
        $search = $request->input('table_search');

        // Jika ada nilai pencarian, filter data admin
        if ($search) {
            $admins = User::where('role', 'admin')
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                ->get();
        } else {
            // Jika tidak ada nilai pencarian, ambil semua data admin
            $admins = User::where('role', 'admin')->get();
        }

        // Kirim data admin ke tampilan blade
        return view('pages.users.admin.index', ['admins' => $admins]);
    }

    public function add(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ]);

            return redirect()->route('admins')->with('success', 'Admin created successfully.');
            
        } catch (\Exception $e) {
            return redirect()->route('admins')->with('error', 'Failed to create admin: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('pages.users.admin.edit', ['admin' => $admin]);
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
            $admin = User::findOrFail($id);
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->alamat = $request->alamat;
            $admin->nomor_hp = $request->nomor_hp;

            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($admin->foto) {
                    Storage::delete('public/fotos/' . $admin->foto);
                }

                // Simpan foto baru
                $imageName = time().'.'.$request->foto->extension();
                $request->foto->storeAs('public/fotos', $imageName);
                $admin->foto = $imageName;
            }

            $admin->save();

            return redirect()->route('admins', $admin->id)->with('success', 'Doctor updated successfully');
        } catch (\Exception $e) {
            // Jika ada error saat update, kembali ke halaman sebelumnya dengan pesan error
            return redirect()->back()->with('error', 'Failed to update doctor. Please try again.')->withInput();
        }
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);

        if ($admin->role !== 'admin') {
            return redirect()->route('admins')->with('error', 'User is not a doctor.');
        }

        $admin->delete();

        return redirect()->route('admins')->with('success', 'Doctor deleted successfully.');
    }
}
