<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Page\DashboardController;
use App\Http\Controllers\Firebase\ContactController;
use App\Http\Controllers\Message\MessagesController;
use App\Http\Controllers\Page\User\AdminsController;
use App\Http\Controllers\Page\User\DoctorsController;
use App\Http\Controllers\Page\User\PasiensController;
use App\Http\Controllers\Page\Antrian\JadwalController;
use App\Http\Controllers\Page\Profile\KlinikController;
use App\Http\Controllers\Page\Antrian\RiwayatController;
use App\Http\Controllers\Page\Profile\PasswordController;
use App\Http\Controllers\Page\Profile\MyprofileController;

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

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::group(['middleware' => ['firebase.auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile/myprofile', [MyprofileController::class, 'index'])->name('profile');
    Route::put('/profile/myprofile/update', [MyprofileController::class, 'update'])->name('profile.update');
    Route::get('/profile/setting', [PasswordController::class, 'index'])->name('profile.setting');
    Route::post('/profile/change-password', [PasswordController::class, 'changePassword'])->name('profile.changePassword');
    //Admin
    Route::get('/admins', [AdminsController::class, 'index'])->name('admins');
    Route::post('/admins/add', [AdminsController::class, 'store'])->name('admins.store');
    Route::get('/admins/edit/{id}', [AdminsController::class, 'edit'])->name('admins.edit');
    Route::put('/admins/update/{id}', [AdminsController::class, 'update'])->name('admins.update');
    Route::delete('/admins/delate/{id}', [AdminsController::class, 'destroy'])->name('admins.destroy');
    //DoctorTabel
    Route::get('/doctors', [DoctorsController::class, 'index'])->name('doctors');
    Route::get('/doctors/edit/{id}', [DoctorsController::class, 'edit'])->name('doctors.edit');
    Route::put('/doctors/update/{id}', [DoctorsController::class, 'update'])->name('doctors.update');
    Route::post('/doctors/add/store', [DoctorsController::class, 'store'])->name('doctors.store');
    Route::delete('/doctors/delate/{id}', [DoctorsController::class, 'destroy'])->name('doctors.destroy');

    //PasienTabel
    Route::get('/pasiens', [PasiensController::class, 'index'])->name('pasiens');
    Route::get('/pasiens/edit/{id}', [PasiensController::class, 'edit'])->name('pasiens.edit');
    Route::get('/pasiens/show/{id}', [PasiensController::class, 'show'])->name('pasiens.show');
    Route::put('/pasiens/update/{id}', [PasiensController::class, 'update'])->name('pasiens.update');
    Route::delete('/pasiens/delate/{id}', [PasiensController::class, 'destroy'])->name('pasiens.destroy');
    Route::post('/pasiens/send-message/{key}', [MessagesController::class, 'send'])->name('pasiens.send-message');
    //jadwal antrian
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
    Route::put('/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
    // Route::get('/jadwal/show/{id}', [JadwalController::class, 'show'])->name('jadwal.show');
    //riwayat
    Route::get('/antrian/riwayat', [RiwayatController::class, 'index'])->name('antrian.riwayat');
    //klinik
    Route::get('/klinik/{id}', [KlinikController::class, 'index'])->name('klinik');
    Route::get('/klinik/edit/{id}', [KlinikController::class, 'edit'])->name('klinik.edit');
    Route::put('/kliniks/update', [KlinikController::class, 'update'])->name('kliniks.update');
    Route::get('/kliniks/{id}/edit-photos', [KlinikController::class, 'editPhotos'])->name('kliniks.editPhotos');
    Route::put('/kliniks/{id}/update-photos', [KlinikController::class, 'updatePhotos'])->name('kliniks.updatePhotos');
    Route::delete('/kliniks/photo/{id}', [KlinikController::class, 'deletePhoto'])->name('kliniks.deletePhoto');
    //logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});