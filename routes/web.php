<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\View\UsersController;
use App\Http\Controllers\View\ViewsController;
use App\Http\Controllers\View\PasiensController;

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

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ViewsController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [ViewsController::class, 'profile'])->name('profile');
    Route::post('/dashboard/profile/user/edit', [UsersController::class, 'update'])->name('user.update');
    Route::get('/dashboard/doctors', [ViewsController::class, 'tableDoctorsView'])->name('doctors');
    Route::get('/dashboard/doctors/add', [ViewsController::class, 'addDoctorsView'])->name('doctors.add');
    Route::post('/dashboard/doctors/add/store', [UsersController::class, 'addDoctors'])->name('doctors.store');
    Route::delete('/dashboard/doctors/{id}', [UsersController::class, 'destroy'])->name('doctors.destroy');
    Route::get('/dashboard/pasiens', [ViewsController::class, 'tablePasiensView'])->name('pasiens');
    Route::get('/pasiens/{id}/edit', [PasiensController::class, 'edit'])->name('pasiens.edit');
    Route::post('/pasiens/{id}', [PasiensController::class, 'update'])->name('pasiens.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
