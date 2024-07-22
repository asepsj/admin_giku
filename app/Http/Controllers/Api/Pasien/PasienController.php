<?php

namespace App\Http\Controllers\Api\Pasien;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the request
        $validator = Validator::make($request->all(), [
            'name_pasien' => 'required|string|max:255',
            'email_pasien' => 'required|string|email|max:255',
            'password' => 'sometimes|string|min:8',
            'foto' => 'nullable|string',
            'alamat' => 'nullable|string',
            'nomor_hp' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find the patient based on the authenticated user
        $pasien = Pasien::where('id', $user->id)->firstOrFail();

        // Update patient details
        $pasien->name_pasien = $request->input('name_pasien');
        $pasien->email_pasien = $request->input('email_pasien');
        if ($request->has('password')) {
            $pasien->password = bcrypt($request->input('password'));
        }
        $pasien->foto = $request->input('foto');
        $pasien->alamat = $request->input('alamat');
        $pasien->nomor_hp = $request->input('nomor_hp');

        // Save the updated patient
        $pasien->save();

        return response()->json(['message' => 'Patient updated successfully', 'data' => $pasien], 200);
    }
}
