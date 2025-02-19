<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TabunganUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    function index()
    {
        return view('landingpage/login');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email Wajib diisi!',
            'password.required' => 'Password Wajib diisi!'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

<<<<<<< HEAD
    // Proses login
if (Auth::attempt($infologin)) {
    // Ambil user yang sedang login
    $user = Auth::user();

    // Langsung cek role tanpa memeriksa verifikasi email
    if ($user->role === 'admin') {
        return redirect()->route('admin')->with('Success', 'Hallo Admin, Anda berhasil login');
    } else if ($user->role === 'user') {
        // Cek apakah user sudah memiliki id_tabungan
        if (!TabunganUser::where('user_id', $user->id)->exists()) {
            // Membuatkan data tabungan untuk user yang belum punya id_tabungan
            TabunganUser::create([
                'user_id' => $user->id,
                'id_tabungan' => TabunganUser::generateIdTabungan(),
                'saldo' => 0, // Default saldo awal
            ]);
        }

        return redirect()->route('user')->with('Success', 'Anda berhasil login');
    }

    } else {
        // Jika email atau password salah
        return redirect()->route('auth')->withErrors('Email atau password salah');
    }

    }
=======
            if ($user->role === 'admin') {
                return redirect()->route('admin')->with('Success', 'Hallo Admin, Anda berhasil login');
            } elseif ($user->role === 'user') {
                if (!TabunganUser::where('user_id', $user->id)->exists()) {
                    TabunganUser::create([
                        'user_id' => $user->id,
                        'id_tabungan' => TabunganUser::generateIdTabungan(),
                        'saldo' => 0,
                    ]);
                }
                return redirect()->route('user')->with('Success', 'Anda berhasil login');
            }
        }
        return redirect()->route('auth')->withErrors('Email atau password salah');
    }
>>>>>>> profile

    function create()
    {
        return view('landingpage/register');
    }

<<<<<<< HEAD
    // function register
    public function register(Request $request)  {
=======
    public function register(Request $request){
>>>>>>> profile
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
            $path = public_path('picture/accounts');
            if (!file_exists($path)) mkdir($path, 0755, true);

            $gambar_file = $request->file('gambar');
            $nama_gambar = date('ymdhis') . '.' . $gambar_file->extension();
            $gambar_file->move($path, $nama_gambar);

            $user = User::create([
                'namalengkap' => $request->namalengkap,
                'kelas' => $request->kelas,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'gambar' => $nama_gambar,
            ]);

            TabunganUser::create([
                'user_id' => $user->id,
                'id_tabungan' => TabunganUser::generateIdTabungan(),
                'saldo' => 0,
            ]);

            return redirect()->route('auth')->with('success', 'Registrasi berhasil. Anda sekarang bisa login.');
        } catch (\Throwable $e) {
            Log::error('Error saat registrasi: ' . $e->getMessage());
            return redirect()->back()->withErrors('Terjadi kesalahan saat registrasi. Silakan coba lagi.')->withInput();
        }
<<<<<<< HEAD

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

        // **Tambahkan pembuatan id_tabungan di sini**
        TabunganUser::create([
            'user_id' => $user->id,
            'id_tabungan' => TabunganUser::generateIdTabungan(), // Fungsi untuk menghasilkan ID tabungan
            'saldo' => 0, // Saldo awal
        ]);
        Log::info('Data tabungan untuk user berhasil dibuat dengan ID tabungan: ' . $user->id);
 
        // Redirect ke halaman login dengan pesan sukses.
        return redirect()->route('auth')->with('success', 'Registrasi berhasil. Anda sekarang bisa login.');

    } catch (\Throwable $e) {
        // **4. Penanganan Error**
        Log::error('Terjadi error saat registrasi: ' . $e->getMessage());
        return redirect()->back()->withErrors('Terjadi kesalahan saat registrasi. Silakan coba lagi.')->withInput();
    }
    
    }

    // controller untuk logout
    function logout() {
        Auth::logout();
        return redirect('/');
    }
}
=======
    }

    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
>>>>>>> profile
