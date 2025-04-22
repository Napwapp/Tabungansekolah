<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TabunganUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

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

    function create()
    {
        return view('landingpage/register');
    }

    public function register(Request $request)
    {
        Log::info('Fungsi register dipanggil.');

        // **1. Validasi Input**
        Log::info('Data yang diterima untuk validasi:', $request->except('gambar')); // Jangan log file gambar secara langsung.
        $request->validate([
            'namalengkap' => 'required|min:5|max:50',
            'kelas' => [
                'required',
                'regex:/^(X|XI|XII)\s(TBSM 1|TBSM 2|RPL|AKL|OTKP|ATPH|TEI)$/'
            ],
            'username' => 'required|min:5|max:18',
            'email' => 'required|unique:users|email',
            'password' => [
                'required',
                'min:8',
                'regex:/\d/', // Harus ada angka
                'same:re_password' 
            ],
            're_password' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'namalengkap.required' => 'Nama lengkap wajib diisi',
            'namalengkap.min' => 'Nama lengkap setidaknya berisi 5 huruf',
            'namalengkap.max' => 'Maksimal 50 Karakter',

            'kelas.required' => 'Kelas wajib diisi',
            'kelas.regex' => 'Kelas tidak valid. Harap memasukan kelas yg benar',

            'username.required' => 'Username wajib diisi',
            'username.min' => 'Username setidaknya berisi 5 huruf',
            'username.max' => 'Username Maksimal 18 karakter',

            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email telah terdaftar',

            'password.required' => 'Password harus diisi',
            'password.min' => 'Password setidaknya berisi 8 karakter',
            'password.regex' => 'Password harus memiliki angka setidaknya 1 angka',
            'password.same' => 'Password dan konfirmasi password harus sama',
            
            're_password.required' => 'Tolong Konfirmasi password mu!',

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
    }

    public function clearErrors(Request $request)
    {
        $request->session()->forget('errors');
        return response()->json(['message' => 'Errors cleared']);
    }

    public function clearSuccess()
    {
        session()->forget('success');
        return response()->json(['message' => 'Success message cleared']);
    }

    // halaman reset password
    public function resetpass()
    {
        return view('landingpage.resetpass.resetpass_1');
    }

    // pemrosesan page 1 reset password
    public function cekEmailResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak terdaftar.'
            ]);
        }

        // Jika email ditemukan
        return response()->json([
            'success' => true,
        ]);
    }

    // Pemrosesan page 2 Mengganti Password
    public function cekPasswordLama(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email tidak ditemukan'], 404);
        }

        $same = Hash::check($request->password_baru, $user->password);

        return response()->json(['same' => $same]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password_baru' => ['required', 'min:8', 'regex:/\d/']
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email tidak ditemukan'], 404);
        }

        $user->password = Hash::make($request->password_baru);
        $user->save();

        return response()->json(['message' => 'Password berhasil diperbarui']);
    }


    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
