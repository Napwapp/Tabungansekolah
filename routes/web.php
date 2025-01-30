<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PlusController;
use App\Http\Controllers\MenabungController;
use App\Http\Controllers\TarikController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'landingpage/landingpage');

// untuk login
Route::get('/sesi',[AuthController::class,'index'])->name('auth');
Route::post('/sesi',[AuthController::class,'login']);

// untuk register
Route::get('/reg',[AuthController::class,'create'])->name('registrasi');
Route::post('/reg',[AuthController::class,'register'])->name('registrasi.post');

// route admin dan user
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/user', [UserController::class, 'index'])->name('user');

// route user (untuk logikanya)
// Route::get('/user', [UserController::class, 'dashboard']);

// route profil 
Route::get('/profile', [ProfileController::class, 'profile'])->name( 'profile');

// route tabungansiswa
Route::get('/tabungan_siswa', [SaveController::class, 'tabungan'])->name( 'tabungan');

// route tabungan kelas
Route::get('/tabungan_kelas', [KelasController::class, 'kelas'])->name( 'kelas');

// route untuk tambah saldo 
Route::get('/Topup saldo', [PlusController::class, 'plus'])->name( 'plus');

// untuk menabung
Route::get('/Menabung', [MenabungController::class, 'menabung'])->name( 'menabung');

// untuk menarik tabungan
Route::get('/Menarik', [TarikController::class, 'menarik'])->name( 'menarik');

// untuk tampilan riwayat transaksi
Route::get('/Riwayat Transaksi', [RiwayatController::class, 'riwayat'])->name( 'riwayat');

// untuk tampilan kontak kami 
Route::get('/Kontak kami', [ContactController::class, 'contact'])->name( 'contact');

