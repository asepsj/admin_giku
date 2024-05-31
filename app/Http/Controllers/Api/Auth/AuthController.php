<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $response = [
        'message' => null,
        'data' => null
    ];

    public function register(Request $req)
    {
        $req->validate([
            'name_pasien' => 'required',
            'email_pasien' => 'required',
            'password' => 'required'
        ]);

        $data = Pasien::create([
            'name_pasien' => $req->name_pasien,
            'email_pasien' => $req->email_pasien,
            'password' => Hash::make($req->password),
        ]);

        $this->response['message'] = 'success';
        $this->response['data'] = $data;
        return response()->json($this->response, 200);
    }

    public function login(Request $req)
    {
        $req->validate([
            'email_pasien' => 'required',
            'password' => 'required'
        ]);

        $user = Pasien::where('email_pasien', $req->email_pasien)->first();

        if (!$user || ! Hash::check($req->password, $user->password)) {
            return response()->json([
                'message' => "failed"
            ]);
        }

        $token =  $user->createToken('API_token')->plainTextToken;
        $this->response['message'] = 'success';
        $this->response['data'] = [
            'token' => $token
        ];

        return response()->json($this->response, 200);
    }

    public function me()
    {
        $user = Auth::user();

        $this->response['message'] = 'success';
        $this->response['data'] = $user;
        
        return response()->json($this->response, 200);
    }

    public function logout()
    {
        $logout = auth()->user()->currentAccessToken()->delete();

        $this->response['message'] = 'success';

        return response()->json($this->response, 200);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $this->validate($request, [
            'name_pasien' => 'required',
            'email_pasien' => 'required|email|unique:doctors,email,'.$user->id,
            'password' => 'nullable|min:6',
        ]);

        // Update profil dokter
        $user->name_pasien = $request->input('name_pasien');
        $user->email_pasien = $request->input('email_pasien');
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
}
