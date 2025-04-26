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
    
    // =================== Rute untuk USER ====================
    Route::middleware(['userAkses:user'])->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user'); //route user
        Route::get('/tabungan/bulanan', [UserController::class, 'getTabunganPerBulan']);
        Route::post('/target-tabungan', [TargetTabunganController::class, 'simpan'])->name('simpanTarget');

        Route::get('/profile', [ProfileController::class, 'profile'])->name('profile'); // route profil 
        Route::post('/profil/user/edit', [ProfileController::class, 'editProfil'])->name('profil.user.update'); // edit profil user
        Route::post('/update-foto-profil', [ProfileController::class, 'updateFotoProfil']); //edit foto profil
        Route::post('/cek-email', [ProfileController::class, 'cekEmail']); // untuk pengecekan email
        Route::get('/tabungan_siswa', [SaveController::class, 'tabungan'])->name('tabungan'); // route tabungansiswa
        Route::get('/tabungan/bulanan', [SaveController::class, 'getTabunganPerBulan']); //grafik tabungan
        Route::get('/tabungan_kelas', [KelasController::class, 'kelas'])->name('kelas'); // route tabungan kelas

        // route bagian tentang keungaan
        Route::get('/Topup-saldo', [PlusController::class, 'plus'])->name('plus'); //route top up saldo     
        Route::get('/cek-status-topup', [TarikController::class, 'cekStatus']);
        Route::post('/isi-saldo', [PlusController::class, 'isiSaldo'])->name('isi-saldo');

        Route::get('/Menabung', [MenabungController::class, 'menabung'])->name('menabung'); // untuk menabung
        Route::post('/tabung-uang', [MenabungController::class, 'tabungUang'])->name('tabung-uang'); // untuk menabung

        Route::get('/Menarik', [TarikController::class, 'menarik'])->name('menarik'); // untuk menarik tabunga
        Route::get('/cek-status-penarikan', [TarikController::class, 'cekStatus']);
        Route::post('/Menarik', [TarikController::class, 'store'])->name('penarikan.store'); // Menyimpan permintaan penarikan
        // akhir route keuangan

        Route::get('/Riwayat_Transaksi', [RiwayatController::class, 'riwayat'])->name('riwayat'); // untuk tampilan riwayat transaksi
        Route::post('/riwayat/hapus/{tipe}/{id}', [RiwayatController::class, 'hapusRiwayat'])->name('riwayat.hapus');

        Route::get('/Pesan', [ContactController::class, 'contact'])->name('contact'); // untuk tampilan kontak kami 
        Route::get('/notifikasi/count-unread', [ContactController::class, 'countUnread'])->name('notifikasi.countUnread');
        Route::get('/notifikasi/filter', [ContactController::class, 'filter']); //filter notifikasi
        Route::post('/notifikasi/mark-all-read', [ContactController::class, 'markAllRead'])->name('notifikasi.markAllRead');
        Route::get('/search-notifications', [ContactController::class, 'searchNotifications'])->name('search.notifications'); // Route untuk pencarian notifikasi
        Route::get('/load-notifications', [ContactController::class, 'loadNotifications'])->name('load.notifications'); // Route untuk memuat semua notifikasi jika tidak ada query pencarian
        Route::get('/pesan/{id}/detail', [ContactController::class, 'getDetail']);
        Route::post('/pesan/{id}/update-status', [ContactController::class, 'updateStatus']); //js yg menangani postnya sudah ada di halaman pesan    
        Route::post('/pesan/hapus/{id}', [ContactController::class, 'hapusNotifikasi']);
        Route::delete('/pesan/hapus-semua-dibaca', [ContactController::class, 'hapusSemuaPesanDibaca'])->name('pesan.hapusSemuaDibaca');
        Route::get('/cek-pesan-dibaca', [ContactController::class, 'cekPesanDibaca']);

        Route::get('/Laporan/dan/Saran', [SendMassageController::class, 'index'])->name('sendmassage'); // Halaman kirim laporan dan saran
        Route::post('/kirim-laporan', [SendMassageController::class, 'kirimLaporan'])->name('laporan.kirim'); // Untuk mengirim laporan dan sarannya
    });

    // =================== Rute untuk ADMIN ====================
    Route::middleware(['userAkses:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin'); // route admin
        Route::get('/admin/profile', [ProfileAdminController::class, 'profiladmin'])->name('profil');
        Route::post('/profil/update', [ProfileAdminController::class, 'update'])->name('profil.update');
        Route::get('/admin/daftaranggota', [AdminController::class, 'daftaranggota'])->name('daftaradnggota');
        Route::get('/admin/data/tabungan_siswa', [KelasAdminController::class, 'kelasmin'])->name('kelasmin');
        Route::post('/keuangan/tambah', [KelasAdminController::class, 'store'])->name('keuangan.store');
        Route::delete('/keuangan/hapus/{id}', [KelasAdminController::class, 'destroy'])->name('keuangan.destroy');
        Route::get('/admin/riwayatadmin', [RiwayatAdminController::class, 'riwayatadmin'])->name('riwayatadmin');
        Route::post('/admin/transaksi/{id}/{type}/{status}', [RiwayatAdminController::class, 'updateStatus'])->name('admin.transaksi.update');
        Route::get('/admin/transaksi', [RiwayatAdminController::class, 'transaksi']);

        // Laporan / Saran Masuk
        Route::get('/admin/pesan', [PesanController::class, 'pesan'])->name('pesan');
        Route::get('/admin/laporan/{id}', [PesanController::class, 'show']);
        Route::post('/admin/laporan/update-status/{id}', [PesanController::class, 'updateStatus']);
        Route::get('/laporan/count-unread', [PesanController::class, 'unreadLaporanCount'])->name('admin.laporan.countUnread');
        Route::post('/admin/mark-all-read', [PesanController::class, 'markAllRead'])->name('admin.markAllRead');
        Route::post('/admin/laporan/{id}/balas', [PesanController::class, 'balasLaporan']); // Logika untuk balas laporan dan saran
        Route::get('/notifikasi/admin/filter', [PesanController::class, 'filterAdmin']); //filter notifikasi
        Route::get('/search-notifications/admin', [PesanController::class, 'searchNotifications'])->name('search.notifications'); // Route untuk pencarian notifikasi
        Route::get('/load-notifications/admin', [PesanController::class, 'loadNotifications'])->name('load.notifications'); // Route untuk memuat semua notifikasi jika tidak ada query pencarian

        Route::get('/admin/daftar/permintaan_transaksi', [PaymentRequestController::class, 'index'])->name('permintaan-transaksi');
        Route::post('/transaksi/{id}/{status}', [PaymentRequestController::class, 'updateTransaksi'])->name('transaksi.update');

        // set konten footer
        Route::get('/Pengaturan', [SetUrlController::class, 'index'])->name('seturl');
        Route::post('/admin/landing/alamat/tambah', [SetUrlController::class, 'alamatStore'])->name('admin.landing.alamat.store');
        Route::post('/admin/landing/alamat/update', [SetUrlController::class, 'alamatUpdate'])->name('admin.landing.alamat.update');
        Route::post('/admin/landing/kontak/tambah', [SetUrlController::class, 'kontakStore'])->name('admin.landing.kontak.store');
        Route::post('/admin/landing/kontak/update', [SetUrlController::class, 'kontakUpdate'])->name('admin.landing.kontak.update');
        Route::post('/admin/landing/kontak/cek-nomor', [SetUrlController::class, 'checkNomor']);
        Route::post('/admin/landing/email/tambah', [SetUrlController::class, 'emailStore'])->name('admin.landing.email.store');
        Route::post('/admin/landing/email/update', [SetUrlController::class, 'emailUpdate'])->name('admin.landing.email.update');
        Route::post('/admin/landing/email/cek-email', [SetUrlController::class, 'checkEmail']);

        // set sosmed
        Route::post('/sosmed/anggota_1', [SetUrlController::class, 'updateAnggota1'])->name('sosmed.update.anggota1');
        Route::post('/sosmed/anggota_2', [SetUrlController::class, 'updateAnggota2'])->name('sosmed.update.anggota2');
        Route::post('/sosmed/anggota_3', [SetUrlController::class, 'updateAnggota3'])->name('sosmed.update.anggota3');
        Route::post('/check-github', [SetUrlController::class, 'checkGithub'])->name('sosmed.check.github');
        Route::post('/check-instagram', [SetUrlController::class, 'checkInstagram'])->name('sosmed.check.instagram');
        Route::post('/check-linkedin', [SetUrlController::class, 'checkLinkedin'])->name('sosmed.check.linkedin');
        // end set sosmed

        Route::get('/admin/edit', [EditProfilController::class, 'edit'])->name('edit');
        Route::get('/tabungan', [SaveController::class, 'tabungan']);
        Route::get('/admin/tabungan', [SaveController::class, 'tabungan']);
        Route::get('/admin/tabungan-per-bulan', [SaveController::class, 'getTabunganPerBulan']);

        Route::get('/Daftar anggota', [DataAnggota::class, 'index'])->name('dataanggota'); //hanya untuk admin        
        Route::post('/updateRole/{id}', [DataAnggota::class, 'updateRole'])->name('updateRole'); // Hilangkan array []
        Route::delete('/datahapus/mass', [DataAnggota::class, 'massDestroy'])->name('datahapus.mass');
        Route::get('/search-data-anggota', [DataAnggota::class, 'searchUsers'])->name('search.users'); // Route untuk pencarian data pengguna
        Route::get('/load-data-anggota', [DataAnggota::class, 'loadSearch'])->name('load.search'); // Route untuk memuat semua data jika tidak ada query pencarian
        Route::post('/admin/tambah-anggota', [DataAnggota::class, 'tambahAnggota'])->name('admin.tambahAnggota');
        Route::post('/admin/tambah-anggota/cek-email', [DataAnggota::class, 'checkEmail']); // Check email


        Route::get('/tabungan', [TabunganController::class, 'getTabunganData']);

        Route::get('/admin/daftar/permintaan_transaksi', [PaymentRequestController::class, 'index'])->name('permintaan-transaksi');
        Route::post('/transaksi/{id}/{status}', [PaymentRequestController::class, 'updateTransaksi'])->name('transaksi.update');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // untuk logout   

});
