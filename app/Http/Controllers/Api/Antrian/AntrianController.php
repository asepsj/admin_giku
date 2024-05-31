<?php

namespace App\Http\Controllers\Api\Antrian;

use App\Models\User;
use App\Models\Pasien;
use App\Models\Antrian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AntrianController extends Controller
{
    public function tambahAntrian(Request $request)
    {
        $user = Auth::user(); // Mengambil data pasien dari token
        $doctor_id = $request->input('doctor_id'); // ID dokter yang dipilih
        $tanggal_antrian = $request->input('tanggal_antrian'); // Tanggal antrian yang dipilih
        $nomor_antrian = $request->input('nomor_antrian');

        if (!$doctor_id || !$tanggal_antrian || !$nomor_antrian) {
            return response()->json(['error' => 'Doctor ID, Tanggal Antrian, dan Nomor Antrian are required.'], 400);
        }

        // Melakukan pengecekan apakah token valid dan memiliki hak akses untuk menambah antrian
        if ($user) {
            $pasien = Pasien::find($user->id);
            $doctor = User::find($doctor_id);

            if (!$pasien || !$doctor) {
                return response()->json(['error' => 'Patient or Doctor not found.'], 404);
            }

           // Memeriksa apakah nomor antrian yang dipilih sudah diambil oleh pasien lain
            $antrianExist = Antrian::where('doctor_id', $doctor_id)
                                    ->where('tanggal_antrian', $tanggal_antrian)
                                    ->where('nombor_antrian', $nomor_antrian)
                                    ->exists();

            if ($antrianExist) {
                return response()->json(['error' => 'Doctor is fully booked for the selected date.'], 400);
            }

            // Memeriksa apakah nomor antrian yang dipilih tersedia
            if ($nomor_antrian > 5) {
                return response()->json(['error' => 'Invalid queue number.'], 400);
            }

            $antrian = Antrian::create([
                'pasien_id' => $user->id,
                'doctor_id' => $doctor_id,
                'name_pasien' => $pasien->name_pasien,
                'name_doctor' => $doctor->name,
                'tanggal_antrian' => $tanggal_antrian,
                'nombor_antrian' => $nomor_antrian,
                'status' => 'berlangsung',
            ]);

            return response()->json([
                'id' => $antrian->id,
                'pasien_name' => $antrian->name_pasien,
                'doctor_name' => $antrian->name_doctor,
                'tanggal_antrian' => $antrian->tanggal_antrian,
                'nomor_antrian' => $antrian->nombor_antrian,
                'status' => $antrian->status,
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function tampilkanAntrian(Request $request)
    {
        $tanggal_antrian = $request->input('tanggal_antrian');
        $user = Auth::user(); // Mengambil data pasien dari token

        // Validasi user
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Validasi input
        if (!$tanggal_antrian) {
            return response()->json(['error' => 'Tanggal antrian dan ID dokter diperlukan.'], 400);
        }

        // Mengambil daftar antrian berdasarkan tanggal dan dokter
        $antrian = Antrian::where('tanggal_antrian', $tanggal_antrian)
                            ->where('doctor_id', $user->id)
                            ->get();

        if ($antrian->isEmpty()) {
            return response()->json(['message' => 'Tidak ada antrian untuk dokter pada tanggal tersebut.'], 404);
        }

        return response()->json($antrian, 200);
    }
}
