<?php

namespace App\Http\Controllers\View;

use App\Models\User;
use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ViewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.admin');
    }

    public function profile()
    {
        // Get the currently authenticated user
        // $user = Auth::user();

        // Pass the user data to the view
        return view('dashboard.doctor.profile');
    }

    public function tableDoctorsView()
    {
         // Ambil semua dokter dari database
        $doctors = User::where('role', 'doctor')->get();
        
         // Kirim data dokter ke tampilan blade
        return view('dashboard.doctor.doctors', ['doctors' => $doctors]);
    }

    public function addDoctorsView()
    {
        return view('dashboard.doctor.add_doctors');
    }

    public function tablePasiensView(Request $request)
    {
        // Ambil semua data pasien dari database
        $pasiens = Pasien::paginate(5);
        
        // Kirim data pasien ke tampilan blade
        return view('dashboard.pasien.pasien_views', ['pasiens' => $pasiens]);
    }
}
