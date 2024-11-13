<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Page\DashboardController;
use App\Http\Controllers\Message\MessagesController;
use App\Http\Controllers\Page\User\AdminsController;
use App\Http\Controllers\Aplikasi\AplikasiController;
use App\Http\Controllers\Page\User\DoctorsController;
use App\Http\Controllers\Page\User\PasiensController;
use App\Http\Controllers\Page\Antrian\JadwalController;
use App\Http\Controllers\Page\Antrian\RiwayatController;
use App\Http\Controllers\Page\Profile\PasswordController;
use App\Http\Controllers\Page\Profile\MyprofileController;
use App\Http\Controllers\Page\Profile\JadwalKerjaController;
use App\Http\Controllers\Page\Profile\JadwalLiburController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/download-app', [AplikasiController::class, 'downloadApp'])->name('download.app');


Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::middleware(['firebase.auth:admin'])->group(function () {
    //user admin
    Route::get('/admins', [AdminsController::class, 'index'])->name('admins');
    Route::post('/admins/add', [AdminsController::class, 'store'])->name('admins.store');
    Route::get('/admins/edit/{id}', [AdminsController::class, 'edit'])->name('admins.edit');
    Route::put('/admins/update/{id}', [AdminsController::class, 'update'])->name('admins.update');
    Route::delete('/admins/delate/{id}', [AdminsController::class, 'destroy'])->name('admins.destroy');
    //user dokter
    Route::get('/doctors', [DoctorsController::class, 'index'])->name('doctors');
    Route::get('/doctors/edit/{id}', [DoctorsController::class, 'edit'])->name('doctors.edit');
    Route::put('/doctors/update/{id}', [DoctorsController::class, 'update'])->name('doctors.update');
    Route::post('/doctors/add/store', [DoctorsController::class, 'store'])->name('doctors.store');
    Route::delete('/doctors/delate/{id}', [DoctorsController::class, 'destroy'])->name('doctors.destroy');

    //user pasien
    Route::get('/pasiens', [PasiensController::class, 'index'])->name('pasiens');
    Route::get('/pasiens/edit/{id}', [PasiensController::class, 'edit'])->name('pasiens.edit');
    Route::get('/pasiens/show/{id}', [PasiensController::class, 'show'])->name('pasiens.show');
    Route::post('/pasiens/add/store', [PasiensController::class, 'store'])->name('pasiens.store');
    Route::put('/pasiens/update/{id}', [PasiensController::class, 'update'])->name('pasiens.update');
    Route::delete('/pasiens/delate/{id}', [PasiensController::class, 'destroy'])->name('pasiens.destroy');
    Route::post('/pasiens/send-message/{key}', [MessagesController::class, 'send'])->name('pasiens.send-message');

    //upload aplikasi
    Route::get('/aplikasi', [AplikasiController::class, 'index'])->name('upload.view');
    Route::post('/aplikasi/upload', [AplikasiController::class, 'uploadFile'])->name('aplikasi.upload');
    Route::delete('/aplikasi/delete', [AplikasiController::class, 'deleteFile'])->name('aplikasi.delete');
});

Route::middleware(['firebase.auth:dokter'])->group(function () {
    // jam kerja
    Route::get('/jadwal-kerja', [JadwalKerjaController::class, 'index'])->name('jadwal-kerja');
    Route::post('/jadwal-kerja', [JadwalKerjaController::class, 'storeWorkSchedule'])->name('jadwal-kerja.store');
    Route::put('/jadwal-kerja/update/{id}', [JadwalKerjaController::class, 'update'])->name('jadwal-kerja.update');
    Route::delete('/jadwal-kerja/delete/{id}', [JadwalKerjaController::class, 'destroy'])->name('jadwal-kerja.delete');
    // jadwal libur
    Route::get('/jadwal-libur', [JadwalLiburController::class, 'index'])->name('jadwal-libur');
    Route::post('/jadwal-libur/store', [JadwalLiburController::class, 'storeHoliday'])->name('jadwal-kerja.store-holiday');
    Route::delete('/jadwal-libur/delate/{id}', [JadwalLiburController::class, 'destroy'])->name('holidays.destroy');
    Route::put('/jadwal-libur/update/{id}', [JadwalLiburController::class, 'update'])->name('holidays.update');
});

Route::middleware(['firebase.auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile/myprofile', [MyprofileController::class, 'index'])->name('profile');
    Route::put('/profile/myprofile/update', [MyprofileController::class, 'update'])->name('profile.update');
    Route::get('/profile/setting', [PasswordController::class, 'index'])->name('profile.setting');
    Route::post('/profile/change-password', [PasswordController::class, 'changePassword'])->name('profile.changePassword');

    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
    Route::put('/jadwal/update/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
    Route::get('/antrian/riwayat', [RiwayatController::class, 'index'])->name('antrian.riwayat');
    Route::get('/jadwal/show/{id}', [JadwalController::class, 'show'])->name('jadwal.show');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});