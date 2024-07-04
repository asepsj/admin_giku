<?php

namespace App\Http\Controllers\Api\Klinik;

use App\Models\User;
use App\Models\Klinik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KlinikController extends Controller
{
    public function show($id)
    {
        // Cari dokter berdasarkan ID
        $doctor = User::findOrFail($id);

        // Ambil klinik yang dimiliki oleh dokter
        $klinik = $doctor->klinik()->with('photos')->first();

        if (!$klinik) {
            return response()->json(['message' => 'Klinik not found'], 404);
        }

        return response()->json($klinik, 200);
    }
}
