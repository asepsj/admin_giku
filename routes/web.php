<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Page\AntrianController;
use App\Http\Controllers\Page\DoctorsController;
use App\Http\Controllers\Page\PasiensController;
use App\Http\Controllers\Page\ProfileController;
use App\Http\Controllers\Page\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    //DoctorTabel
    Route::get('/doctors', [DoctorsController::class, 'index'])->name('doctors');
    Route::get('/doctors/add', [DoctorsController::class, 'addView'])->name('doctors.add');
    Route::get('/doctors/edit/{id}', [DoctorsController::class, 'edit'])->name('doctors.edit');
    Route::post('/doctors/update/{id}', [DoctorsController::class, 'update'])->name('doctors.update');
    Route::post('/doctors/add/store', [DoctorsController::class, 'add'])->name('doctors.store');
    Route::delete('/doctors/delate/{id}', [DoctorsController::class, 'destroy'])->name('doctors.destroy');
    //Pasientabel
    Route::get('/pasiens', [PasiensController::class, 'index'])->name('pasiens');
    Route::get('/pasiens/edit/{id}', [PasiensController::class, 'edit'])->name('pasiens.edit');
    Route::post('/pasiens/update/{id}', [PasiensController::class, 'update'])->name('pasiens.update');
    Route::delete('/pasiens/delate/{id}', [PasiensController::class, 'destroy'])->name('pasiens.destroy');
    //Antrian
    Route::get('/antrian', [AntrianController::class, 'index'])->name('antrian');
    //logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
