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
use App\Http\Controllers\DataMahasiswa;

// admin
use App\Http\Controllers\KelasAdminController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\RiwayatAdminController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\EditProfilController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

    // route group yg belum login (perlu direvisi)
    // Route::middleware(['guest'])->group(function() {
    Route::middleware(['guest'])->group(function(){
        Route::view('/', 'landingpage/landingpage');
        Route::get('/sesi',[AuthController::class,'index'])->name('auth');  // untuk login
        Route::post('/sesi',[AuthController::class,'login']);
        Route::get('/reg',[AuthController::class,'create'])->name('registrasi');  // untuk register
        Route::post('/reg',[AuthController::class,'register'])->name('registrasi.post');
    });


    //route grup yang sudah login
    // Route::middleware(['auth'])->group(function() {
    Route::middleware(['auth'])->group(function(){
        Route::redirect('/home','/user');
        Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('userAkses:admin'); // route admin
        Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('userAkses:user'); //route user
        
        Route::get('/profile', [ProfileController::class, 'profile'])->name('profile'); // route profil 
        Route::get('/tabungan_siswa', [SaveController::class, 'tabungan'])->name( 'tabungan'); // route tabungansiswa
        Route::get('/tabungan_kelas', [KelasController::class, 'kelas'])->name( 'kelas'); // route tabungan kelas
        Route::get('/Topup saldo', [PlusController::class, 'plus'])->name( 'plus'); // route untuk tambah saldo 
        Route::get('/Menabung', [MenabungController::class, 'menabung'])->name( 'menabung'); // untuk menabung
        Route::get('/Menarik', [TarikController::class, 'menarik'])->name( 'menarik'); // untuk menarik tabungan
        Route::get('/Riwayat Transaksi', [RiwayatController::class, 'riwayat'])->name( 'riwayat'); // untuk tampilan riwayat transaksi
        Route::get('/Kontak kami', [ContactController::class, 'contact'])->name( 'contact'); // untuk tampilan kontak kami 
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // untuk logout

        Route::get('/Daftar anggota Tabungan Sekolah SMKN1 Binong subang',[DataMahasiswa::class, 'index'])->name('dataanggota'); //hanya untuk admin
        Route::get('/datatambah', [DataMahasiswa::class, 'tambah']);
        Route::get('/dataedit/{id}', [DataMahasiswa::class, 'edit']);
        Route::post('/datahapus/{id}', [DataMahasiswa::class, 'hapus']);
    });
 
        // Route::redirect('/home', '/user');
        Route::get('/admin/profile', [AdminController::class, 'adminprofil'])->name('profil');
        Route::get('/admin/daftaranggota', [AdminController::class, 'daftaranggota'])->name('daftaradnggota');
        Route::get('/admin/tabungan_kelas_admin', [KelasAdminController::class, 'kelasmin'])->name('kelasmin');
        Route::post('/keuangan/tambah', [KelasAdminController::class, 'store'])->name('keuangan.store');
        Route::delete('/keuangan/hapus/{id}', [KelasAdminController::class, 'destroy'])->name('keuangan.destroy');
        Route::get('/admin/datasiswa', [DataSiswaController::class, 'datasiswa'])->name('datasiswa');
        Route::get('/admin/riwayatadmin', [RiwayatAdminController::class, 'riwayatadmin'])->name('riwayatadmin');
        Route::post('/admin/transaksi/{id}/{type}/{status}', [RiwayatAdminController::class, 'updateStatus'])->name('admin.transaksi.update');
        Route::get('/admin/transaksi', [RiwayatAdminController::class, 'transaksi']);
        Route::get('/admin/pesan', [PesanController::class, 'pesan'])->name('pesan');
        Route::get('/admin/edit', [EditProfilController::class, 'edit   '])->name('edit');


// route user (untuk logikanya)
// Route::get('/user', [UserController::class, 'dashboard']);


