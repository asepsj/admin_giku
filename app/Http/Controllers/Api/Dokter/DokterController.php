<?php

namespace App\Http\Controllers\Api\Dokter;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DokterController extends Controller
{
    public function index()
    {
        // Ambil data user dengan role "doctor"
        $doctors = User::where('role', 'doctor')->get();

        // Kembalikan response JSON
        return response()->json(['data'=>$doctors]);
    }

    public function show($id)
    {
        $dokter = User::findOrFail($id);

        if (!$dokter) {
            return response()->json([
                'message' => 'Dokter tidak ditemukan'
            ], 404);
        }

        return response()->json($dokter);
    }
}
