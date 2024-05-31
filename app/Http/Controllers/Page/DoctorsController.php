<?php

namespace App\Http\Controllers\Page;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

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
                ->get();
        } else {
            // Jika tidak ada nilai pencarian, ambil semua data dokter
            $doctors = User::where('role', 'doctor')->get();
        }
            
            // Kirim data dokter ke tampilan blade
            return view('dashboard.doctor.doctors', ['doctors' => $doctors]);
    }

    public function addView()
    {
        return view('dashboard.doctor.add');
    }

    public function add(Request $request)
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

    public function edit($id)
    {
        $doctor = User::findOrFail($id);
        return view('dashboard.doctor.edit', ['doctor' => $doctor]);
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

        $doctor = User::findOrFail($id);
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->alamat = $request->alamat;
        $doctor->nomor_hp = $request->nomor_hp;

        if ($request->hasFile('foto')) {
            $imageName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('images'), $imageName);
            $doctor->foto = $imageName;
        }

        $doctor->save();

        return redirect()->route('doctors.edit', $doctor->id)->with('success', 'Doctor updated successfully');
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
