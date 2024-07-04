<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Dokter\DokterController;
use App\Http\Controllers\Api\Klinik\KlinikController;
use App\Http\Controllers\Api\Antrian\AntrianController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/login', [AuthController::class,'login']);
Route::post('auth/register', [AuthController::class,'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/me', [AuthController::class,'me']);
    Route::post('auth/logout', [AuthController::class,'logout']);
    Route::post('auth/pasien/antrian/tambah', [AntrianController::class, 'tambahAntrian']);
    Route::get('auth/pasien/antrian', [AntrianController::class, 'getAntrianByPasien']);
    Route::get('auth/doctor/antrian', [AntrianController::class, 'tampilkanAntrian']);
    Route::get('/pasien/doctors', [DokterController::class, 'index']);
    Route::get('/pasien/dokter/{id}', [DokterController::class, 'show']);
});
