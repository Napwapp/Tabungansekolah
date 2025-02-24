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
use App\Http\Controllers\TargetTabunganController;
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
Route::middleware(['guest'])->group(function () {
    Route::view('/', 'landingpage/landingpage');
    Route::get('/sesi', [AuthController::class, 'index'])->name('auth');  // untuk login
    Route::post('/sesi', [AuthController::class, 'login']);
    Route::get('/reg', [AuthController::class, 'create'])->name('registrasi');  // untuk register
    Route::post('/reg', [AuthController::class, 'register'])->name('registrasi.post');
});


//route grup yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::redirect('/home', '/user');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('userAkses:admin'); // route admin

    Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('userAkses:user'); //route user
    Route::get('/tabungan/bulanan', [UserController::class, 'getTabunganPerBulan']);
    Route::post('/target-tabungan', [TargetTabunganController::class, 'simpan'])->name('simpanTarget');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile'); // route profil 
    Route::get('/tabungan_siswa', [SaveController::class, 'tabungan'])->name('tabungan'); // route tabungansiswa
    Route::get('/tabungan/bulanan', [SaveController::class, 'getTabunganPerBulan']); //grafik tabungan
    Route::get('/tabungan_kelas', [KelasController::class, 'kelas'])->name('kelas'); // route tabungan kelas

    // route bagian tentang keungaan
    Route::get('/Topup-saldo', [PlusController::class, 'plus'])->name('plus'); //route top up saldo     
    Route::post('/isi-saldo', [PlusController::class, 'isiSaldo'])->name('isi-saldo');

    Route::get('/Menabung', [MenabungController::class, 'menabung'])->name('menabung'); // untuk menabung
    Route::post('/tabung-uang', [MenabungController::class, 'tabungUang'])->name('tabung-uang'); // untuk menabung

    Route::get('/Menarik', [TarikController::class, 'menarik'])->name('menarik'); // untuk menarik tabunga
    Route::post('/Menarik', [TarikController::class, 'store'])->name('penarikan.store'); // Menyimpan permintaan penarikan
    // akhir route keuangan

    Route::get('/Riwayat_Transaksi', [RiwayatController::class, 'riwayat'])->name('riwayat'); // untuk tampilan riwayat transaksi
    Route::post('/riwayat/hapus/{tipe}/{id}', [RiwayatController::class, 'hapusRiwayat'])->name('riwayat.hapus');

    Route::get('/Pesan', [ContactController::class, 'contact'])->name('contact'); // untuk tampilan kontak kami 
    Route::get('/pesan/{id}/detail', [ContactController::class, 'getDetail']);
    Route::post('/pesan/{id}/update-status', [ContactController::class, 'updateStatus']); //js yg menangani postnya sudah ada di halaman pesan    

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // untuk logout
    Route::get('/Daftar anggota Tabungan Sekolah SMKN1 Binong subang', [DataMahasiswa::class, 'index'])->name('dataanggota'); //hanya untuk admin
    Route::get('/datatambah', [DataMahasiswa::class, 'tambah']);
    Route::get('/dataedit/{id}', [DataMahasiswa::class, 'edit']);
    Route::post('/datahapus/{id}', [DataMahasiswa::class, 'hapus']);
});
   

    // Route::redirect('/home', '/user');
    






// route user (untuk logikanya)
// Route::get('/user', [UserController::class, 'dashboard']);
