<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PlusController;
use App\Http\Controllers\MenabungController;
use App\Http\Controllers\TarikController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TargetTabunganController;

// admin
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataAnggota;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\KelasAdminController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\RiwayatAdminController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\EditProfilController;
use App\Http\Controllers\PaymentRequestController;
use App\Http\Controllers\SendMassageController;
use App\Http\Controllers\SetUrlController;
use App\Http\Controllers\TabunganController;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [LandController::class, 'index']);  // untuk login
    Route::get('/sesi', [AuthController::class, 'index'])->name('auth');  // untuk login
    Route::post('/sesi', [AuthController::class, 'login']);
    Route::get('/reg', [AuthController::class, 'create'])->name('registrasi');  // untuk register
    Route::post('/reg', [AuthController::class, 'register'])->name('registrasi.post');
    Route::post('/clear-errors', [AuthController::class, 'clearErrors'])->name('clear.errors');
    Route::post('/clear-success', [AuthController::class, 'clearSuccess'])->name('clear.success');
    Route::get('/Reset_Password', [AuthController::class, 'resetpass'])->name('reset_halaman1');  // untuk login        
    Route::post('/cek-email-reset-password', [AuthController::class, 'cekEmailResetPassword']);
    Route::post('/cek-password-lama', [AuthController::class, 'cekPasswordLama']);
    Route::post('/update-password', [AuthController::class, 'updatePassword']);
});

//route grup yang sudah login 
Route::middleware(['auth'])->group(function () {
    Route::redirect('/home', '/user');

    Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('userAkses:user'); //route user
    Route::get('/tabungan/bulanan', [UserController::class, 'getTabunganPerBulan'])->middleware('userAkses:user');
    Route::post('/target-tabungan', [TargetTabunganController::class, 'simpan'])->name('simpanTarget')->middleware('userAkses:user');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile')->middleware('userAkses:user'); // route profil 
    Route::post('/profil/user/edit', [ProfileController::class, 'editProfil'])->name('profil.user.update')->middleware('userAkses:user'); // edit profil user
    Route::post('/update-foto-profil', [ProfileController::class, 'updateFotoProfil'])->middleware('userAkses:user'); //edit foto profil
    Route::post('/cek-email', [ProfileController::class, 'cekEmail'])->middleware('userAkses:user'); // untuk pengecekan email
    Route::get('/tabungan_siswa', [SaveController::class, 'tabungan'])->name('tabungan')->middleware('userAkses:user'); // route tabungansiswa
    Route::get('/tabungan/bulanan', [SaveController::class, 'getTabunganPerBulan'])->middleware('userAkses:user'); //grafik tabungan
    Route::get('/tabungan_kelas', [KelasController::class, 'kelas'])->name('kelas')->middleware('userAkses:user'); // route tabungan kelas

    // route bagian tentang keungaan
    Route::get('/Topup-saldo', [PlusController::class, 'plus'])->name('plus')->middleware('userAkses:user'); //route top up saldo     
    Route::get('/cek-status-topup', [TarikController::class, 'cekStatus'])->middleware('userAkses:user');
    Route::post('/isi-saldo', [PlusController::class, 'isiSaldo'])->name('isi-saldo')->middleware('userAkses:user');

    Route::get('/Menabung', [MenabungController::class, 'menabung'])->name('menabung')->middleware('userAkses:user'); // untuk menabung
    Route::post('/tabung-uang', [MenabungController::class, 'tabungUang'])->name('tabung-uang')->middleware('userAkses:user'); // untuk menabung

    Route::get('/Menarik', [TarikController::class, 'menarik'])->name('menarik')->middleware('userAkses:user'); // untuk menarik tabunga
    Route::get('/cek-status-penarikan', [TarikController::class, 'cekStatus'])->middleware('userAkses:user');
    Route::post('/Menarik', [TarikController::class, 'store'])->name('penarikan.store')->middleware('userAkses:user'); // Menyimpan permintaan penarikan
    // akhir route keuangan

    Route::get('/Riwayat_Transaksi', [RiwayatController::class, 'riwayat'])->name('riwayat')->middleware('userAkses:user'); // untuk tampilan riwayat transaksi
    Route::post('/riwayat/hapus/{tipe}/{id}', [RiwayatController::class, 'hapusRiwayat'])->name('riwayat.hapus')->middleware('userAkses:user');

    Route::get('/Pesan', [ContactController::class, 'contact'])->name('contact')->middleware('userAkses:user'); // untuk tampilan kontak kami 
    Route::get('/notifikasi/count-unread', [ContactController::class, 'countUnread'])->name('notifikasi.countUnread')->middleware('userAkses:user');
    Route::get('/notifikasi/filter', [ContactController::class, 'filter'])->middleware('userAkses:user'); //filter notifikasi
    Route::post('/notifikasi/mark-all-read', [ContactController::class, 'markAllRead'])->name('notifikasi.markAllRead')->middleware('userAkses:user');
    Route::get('/search-notifications', [ContactController::class, 'searchNotifications'])->name('search.notifications')->middleware('userAkses:user'); // Route untuk pencarian notifikasi
    Route::get('/load-notifications', [ContactController::class, 'loadNotifications'])->name('load.notifications')->middleware('userAkses:user'); // Route untuk memuat semua notifikasi jika tidak ada query pencarian
    Route::get('/pesan/{id}/detail', [ContactController::class, 'getDetail'])->middleware('userAkses:user');
    Route::post('/pesan/{id}/update-status', [ContactController::class, 'updateStatus'])->middleware('userAkses:user'); //js yg menangani postnya sudah ada di halaman pesan    
    Route::post('/pesan/hapus/{id}', [ContactController::class, 'hapusNotifikasi'])->middleware('userAkses:user');
    Route::delete('/pesan/hapus-semua-dibaca', [ContactController::class, 'hapusSemuaPesanDibaca'])->name('pesan.hapusSemuaDibaca')->middleware('userAkses:user');
    Route::get('/cek-pesan-dibaca', [ContactController::class, 'cekPesanDibaca'])->middleware('userAkses:user');

    Route::get('/Laporan/dan/Saran', [SendMassageController::class, 'index'])->name('sendmassage')->middleware('userAkses:user'); // Halaman kirim laporan dan saran
    Route::post('/kirim-laporan', [SendMassageController::class, 'kirimLaporan'])->name('laporan.kirim')->middleware('userAkses:user'); // Untuk mengirim laporan dan sarannya

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // untuk logout   

    // Akses Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('userAkses:admin'); // route admin
    Route::get('/admin/profile', [ProfileAdminController::class, 'profiladmin'])->name('profil')->middleware('userAkses:admin');
    Route::post('/profil/update', [ProfileAdminController::class, 'update'])->name('profil.update')->middleware('userAkses:admin');
    Route::get('/admin/daftaranggota', [AdminController::class, 'daftaranggota'])->name('daftaradnggota')->middleware('userAkses:admin');
    Route::get('/admin/data/tabungan_siswa', [KelasAdminController::class, 'kelasmin'])->name('kelasmin')->middleware('userAkses:admin');
    Route::post('/keuangan/tambah', [KelasAdminController::class, 'store'])->name('keuangan.store')->middleware('userAkses:admin');
    Route::delete('/keuangan/hapus/{id}', [KelasAdminController::class, 'destroy'])->name('keuangan.destroy')->middleware('userAkses:admin');
    Route::get('/admin/riwayatadmin', [RiwayatAdminController::class, 'riwayatadmin'])->name('riwayatadmin')->middleware('userAkses:admin');
    Route::post('/admin/transaksi/{id}/{type}/{status}', [RiwayatAdminController::class, 'updateStatus'])->name('admin.transaksi.update')->middleware('userAkses:admin');
    Route::get('/admin/transaksi', [RiwayatAdminController::class, 'transaksi'])->middleware('userAkses:admin');

    // Laporan / Saran Masuk
    Route::get('/admin/pesan', [PesanController::class, 'pesan'])->name('pesan')->middleware('userAkses:admin');
    Route::get('/admin/laporan/{id}', [PesanController::class, 'show'])->middleware('userAkses:admin');
    Route::post('/admin/laporan/update-status/{id}', [PesanController::class, 'updateStatus'])->middleware('userAkses:admin');
    Route::get('/laporan/count-unread', [PesanController::class, 'unreadLaporanCount'])->name('admin.laporan.countUnread')->middleware('userAkses:admin');
    Route::post('/admin/mark-all-read', [PesanController::class, 'markAllRead'])->name('admin.markAllRead')->middleware('userAkses:admin');
    Route::post('/admin/laporan/{id}/balas', [PesanController::class, 'balasLaporan'])->middleware('userAkses:admin'); // Logika untuk balas laporan dan saran
    Route::get('/notifikasi/admin/filter', [PesanController::class, 'filterAdmin'])->middleware('userAkses:admin'); //filter notifikasi
    Route::get('/search-notifications/admin', [PesanController::class, 'searchNotifications'])->name('search.notifications')->middleware('userAkses:admin'); // Route untuk pencarian notifikasi
    Route::get('/load-notifications/admin', [PesanController::class, 'loadNotifications'])->name('load.notifications')->middleware('userAkses:admin'); // Route untuk memuat semua notifikasi jika tidak ada query pencarian

    Route::get('/admin/daftar/permintaan_transaksi', [PaymentRequestController::class, 'index'])->name('permintaan-transaksi')->middleware('userAkses:admin');
    Route::post('/transaksi/{id}/{status}', [PaymentRequestController::class, 'updateTransaksi'])->name('transaksi.update')->middleware('userAkses:admin');

    // set konten footer
    Route::get('/Pengaturan', [SetUrlController::class, 'index'])->name('seturl')->middleware('userAkses:admin');
    Route::post('/admin/landing/alamat/tambah', [SetUrlController::class, 'alamatStore'])->name('admin.landing.alamat.store')->middleware('userAkses:admin');
    Route::post('/admin/landing/alamat/update', [SetUrlController::class, 'alamatUpdate'])->name('admin.landing.alamat.update')->middleware('userAkses:admin');
    Route::post('/admin/landing/kontak/tambah', [SetUrlController::class, 'kontakStore'])->name('admin.landing.kontak.store')->middleware('userAkses:admin');
    Route::post('/admin/landing/kontak/update', [SetUrlController::class, 'kontakUpdate'])->name('admin.landing.kontak.update')->middleware('userAkses:admin');
    Route::post('/admin/landing/kontak/cek-nomor', [SetUrlController::class, 'checkNomor'])->middleware('userAkses:admin');
    Route::post('/admin/landing/email/tambah', [SetUrlController::class, 'emailStore'])->name('admin.landing.email.store')->middleware('userAkses:admin');
    Route::post('/admin/landing/email/update', [SetUrlController::class, 'emailUpdate'])->name('admin.landing.email.update')->middleware('userAkses:admin');
    Route::post('/admin/landing/email/cek-email', [SetUrlController::class, 'checkEmail'])->middleware('userAkses:admin');

    // set sosmed
    Route::post('/sosmed/anggota_1', [SetUrlController::class, 'updateAnggota1'])->name('sosmed.update.anggota1')->middleware('userAkses:admin');
    Route::post('/sosmed/anggota_2', [SetUrlController::class, 'updateAnggota2'])->name('sosmed.update.anggota2')->middleware('userAkses:admin');
    Route::post('/sosmed/anggota_3', [SetUrlController::class, 'updateAnggota3'])->name('sosmed.update.anggota3')->middleware('userAkses:admin');
    Route::post('/check-github', [SetUrlController::class, 'checkGithub'])->name('sosmed.check.github')->middleware('userAkses:admin');
    Route::post('/check-instagram', [SetUrlController::class, 'checkInstagram'])->name('sosmed.check.instagram')->middleware('userAkses:admin');
    Route::post('/check-linkedin', [SetUrlController::class, 'checkLinkedin'])->name('sosmed.check.linkedin')->middleware('userAkses:admin');
    // end set sosmed

    Route::get('/admin/edit', [EditProfilController::class, 'edit'])->name('edit')->middleware('userAkses:admin');
    Route::get('/tabungan', [SaveController::class, 'tabungan'])->middleware('userAkses:admin');
    Route::get('/admin/tabungan', [SaveController::class, 'tabungan'])->middleware('userAkses:admin');
    Route::get('/admin/tabungan-per-bulan', [SaveController::class, 'getTabunganPerBulan'])->middleware('userAkses:admin');

    Route::get('/Daftar anggota', [DataAnggota::class, 'index'])->name('dataanggota')->middleware('userAkses:admin'); //hanya untuk admin        
    Route::post('/updateRole/{id}', [DataAnggota::class, 'updateRole'])->name('updateRole')->middleware('userAkses:admin'); // Hilangkan array []
    Route::delete('/datahapus/mass', [DataAnggota::class, 'massDestroy'])->name('datahapus.mass')->middleware('userAkses:admin');
    Route::get('/search-data-anggota', [DataAnggota::class, 'searchUsers'])->name('search.users')->middleware('userAkses:admin'); // Route untuk pencarian data pengguna
    Route::get('/load-data-anggota', [DataAnggota::class, 'loadSearch'])->name('load.search')->middleware('userAkses:admin'); // Route untuk memuat semua data jika tidak ada query pencarian
    Route::post('/admin/tambah-anggota', [DataAnggota::class, 'tambahAnggota'])->name('admin.tambahAnggota')->middleware('userAkses:admin');
    Route::post('/admin/tambah-anggota/cek-email', [DataAnggota::class, 'checkEmail'])->middleware('userAkses:admin'); // Check email


    Route::get('/tabungan', [TabunganController::class, 'getTabunganData'])->middleware('userAkses:admin');

    Route::get('/admin/daftar/permintaan_transaksi', [PaymentRequestController::class, 'index'])->name('permintaan-transaksi')->middleware('userAkses:admin');
    Route::post('/transaksi/{id}/{status}', [PaymentRequestController::class, 'updateTransaksi'])->name('transaksi.update')->middleware('userAkses:admin');
})->middleware('userAkses:admin');
