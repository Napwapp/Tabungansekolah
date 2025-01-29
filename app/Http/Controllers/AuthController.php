<?php

namespace App\Http\Controllers;

use App\Mail\AuthMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // untuk menampilkan halaman login
    function index () {
        return view('landingpage/login');
    }

    function login(Request $request)
{
    // Validasi input
    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ], [
        'email.required' => 'Email Wajib diisi!',
        'password.required' => 'Password Wajib diisi!'
    ]);

    // Informasi login
    $infologin = [
        'email' => $request->email,
        'password' => $request->password
    ];

    // Proses login
    if (Auth::attempt($infologin)) {
        // Langsung cek role tanpa memeriksa verifikasi email
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin')->with('Success', 'Hallo Admin, Anda berhasil login');
        } else if (Auth::user()->role === 'user') {
            return redirect()->route('user')->with('Success', 'Anda berhasil login');
        }
    } else {
        // Jika email atau password salah
        return redirect()->route('auth')->withErrors('Email atau password salah');
    }
    
    }

    function create () {
        return view('landingpage/register');
    }

    public function register(Request $request)  {
    Log::info('Fungsi register dipanggil.');

    // **1. Validasi Input**
    Log::info('Data yang diterima untuk validasi:', $request->except('gambar')); // Jangan log file gambar secara langsung.
    $request->validate([
        'namalengkap' => 'required|min:5',
        'kelas' => 'required|min:5',
        'username' => 'required|min:5|max:18',
        'email' => 'required|unique:users|email',
        'password' => [
            'required',
            'min:8',
            'regex:/\d/', // Password harus mengandung setidaknya 1 angka.
        ],
        'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048' // Validasi gambar.
    ], [
        'namalengkap.required' => 'Nama lengkap wajib diisi',
        'namalengkap.min' => 'Nama lengkap setidaknya berisi 5 huruf',
        'kelas.required' => 'Kelas wajib diisi',
        'kelas.min' => 'Kelas setidaknya berisi 5 karakter',
        'username.required' => 'Username wajib diisi',
        'username.min' => 'Username setidaknya berisi 5 huruf',
        'username.max' => 'Maksimal 18 karakter',
        'email.required' => 'Email wajib diisi',
        'email.unique' => 'Email telah terdaftar',
        'password.required' => 'Password harus diisi',
        'password.min' => 'Password setidaknya berisi 8 karakter',
        'password.regex' => 'Password harus memiliki angka setidaknya 1 angka',
        'gambar.required' => 'Gambar wajib diupload',
        'gambar.image' => 'Gambar yang diupload harus berupa file gambar',
    ]);

    Log::info('Validasi berhasil.');

    try {
        // **2. Proses Upload Gambar**
        Log::info('Proses upload gambar dimulai.');

        // Pastikan folder tujuan ada, buat jika belum ada.
        $path = public_path('picture/accounts');
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
            Log::info('Folder untuk gambar dibuat: ' . $path);
        }

        // Ambil file gambar dari request.
        $gambar_file = $request->file('gambar');

        // Generate nama file unik dengan timestamp.
        $nama_gambar = date('ymdhis') . "." . $gambar_file->extension();

        // Pindahkan file gambar ke folder tujuan.
        $gambar_file->move($path, $nama_gambar);
        Log::info('Gambar berhasil diupload ke: ' . $path . '/' . $nama_gambar);

        // **3. Simpan Data ke Database**
        Log::info('Data user yang akan disimpan:', [
            'namalengkap' => $request->namalengkap,
            'kelas' => $request->kelas,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'gambar' => $nama_gambar,
        ]);

        $user = User::create([
            'namalengkap' => $request->namalengkap,
            'kelas' => $request->kelas,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'gambar' => $nama_gambar,
        ]);
        Log::info('Data user berhasil disimpan ke database dengan ID: ' . $user->id);

        // Redirect ke halaman login dengan pesan sukses.
        return redirect()->route('auth')->with('success', 'Registrasi berhasil. Anda sekarang bisa login.');

    } catch (\Throwable $e) {
        // **4. Penanganan Error**
        Log::error('Terjadi error saat registrasi: ' . $e->getMessage());
        return redirect()->back()->withErrors('Terjadi kesalahan saat registrasi. Silakan coba lagi.')->withInput();
    }
    
    }

}
