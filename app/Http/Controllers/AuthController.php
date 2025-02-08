<?php

namespace App\Http\Controllers;

use App\Mail\AuthMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // untuk menampilkan halaman login
    function index () {
        return view('landingpage/login');
    }

    function login (Request $request) {
        // untuk validasi login
        $request->validate([
            'email'=> 'required',
            'password'=> 'required',
        ], [ 
            'email.required' => 'Email Wajib diisi!', 
            'password.required' => 'Password Wajib diisi!', 
        ]);
        
        // infologin yg mengambil data dari login itu
        $infologin = [ 
            // 'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)) {
            if (Auth::user()->email_verified_at != null) {
                if (Auth::user()->role === 'admin') {
                    return redirect()->route('admin')->with('Success', 'Hallo Admin, Anda berhasi Login');
                } else if(Auth::user()->role === 'user') {
                    return redirect()->route('user')->with('Success','Anda berhasil Login');         
                }
            } else {
                Auth::logout();
                return redirect()->route ('auth')->withErrors('Email atau Password Salah');
            }
            // return 'Login Berhasil';  (jika ada error mungkin perli dikembalikan)
        } else {
            return redirect()->route ('auth')->withErrors('Akun anda belum Aktif, Harap Verifikasi terlebih dahulu');
        }
    }
    function create () {
        return view('landingpage/register');
    }

    function register (Request $request) {
        // kode untuk mengenerate verifikasi yg akan dikirim ke email user
        $str = Str::random(100);

        // validasi untuk register
        $request->validate([
            'namalengkap' => 'required|min:5',
            'kelas' => 'required|min:5',
            'username' => 'required|min:5|max:18',
            'email' => 'required|unique:users|email',
            'password' =>[
                'required|min:8',
                'regex:/^(?=(.*\d){3,}).*$/', // Minimal 3 angka
                'confirmed'] ,
            're_password' => 'required|same:password',
            'gambar' => 'required|image|file'
        ],[
            'namalengkap.required' => 'Nama lengkap Wajib diisi',
            'namalengkap.min' => 'Nama lengkap setidaknya berisi 5 Huruf',
            'kelas.required' => 'Kelas Wajib diisi',
            'kelas.min' => 'Kelas setidaknya berisi 5 Karakter',
            'username.required' => 'Username Wajib diisi',
            'username.min' => 'Username setidaknya berisi 5 Huruf',
            'username.max' => 'Maksimal 18 Karakter',
            'email.required' => 'Email Wajib diisi',
            'email.unique' => 'Email telah Terdaftar',
            'password.required' => 'Password harus Diisi',
            'password.min' => 'Password setidaknya berisi 8 Karakter',
            'password.regex' => 'Password harus memiliki angka setidaknya 3 Angka',
            're_password.required' => 'Harus diisi',
            're_password.same' => 'Harus sama dengan password yang kamu buat Diatas',
            'gambar.required' => 'Gambar Wajib Diupload',
            'gambar.image' => 'Gambar yang di Upload harus berupa image',
            'gambar.file' => 'Gambar harus berupa file'
        ]); 

        $gambar_file = $request->file('gambar');
        // untuk mengambil ekstensi gambar
        $gambar_ekstensi = $gambar_file->extension();
        // untuk mengambil nama gambar dna untuk menggabungkan nama gambar(yg menggunakan tanggal) dengan ekstensi gambar
        $nama_gambar = date('ymdhis') . " . " . $gambar_ekstensi;
        // untuk mengambil gambarnya dan menyimpan ke dalam folder lokal(publik) kita
        $gambar_file->move(public_path('picture/accounts'), $nama_gambar);

        // untuk data infon registrasinya
        $inforegister = [
            'namalengkap' => $request->namalengkap,
            'kelas' => $request->kelas,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            're_password' => $request->re_password,
            'gambar' => $nama_gambar,
            'verify_key' => $str
        ];

        // menambahkan data data diatas ke databasenya
        User::create($inforegister);

        // data / pesan yg nanti akan dikirimkan ke email yg didaftarkan pada saat user registrasi
        $details = [
            'nama' => $inforegister['namalengkap'],
            'role' => 'user',
            'datetime' => date('Y-m-d H:i:s'),
            'website' => 'Tabungan Sekolah ',
            'url' => 'http://'. request()->getHttpHost() . "/" . "verify/" . $inforegister['verify_key'],
        ];

        Mail::to($inforegister['email'])->send(new AuthMail($details));

        return redirect()->route('auth')->with('success', 'Link verifikasi telah dikirim ke Email Anda. Silahkan cek Email untuk Verifikasi');
    }
    function verify($verify_key){
        
        $keyCheck = User::select('verify_key')
        ->where('verify_key',$verify_key)
        ->exists();

        if($keyCheck){
            $user = User::where('verify_key',$verify_key)->update(['email_verified_at' => date('Y-m-d H:i:s')]);
            return redirect()->route('auth')->with('Success', 'Verifikasi telah berhasil. Akun anda sudah aktif.');
        } else {
            return redirect()->route('auth')->withErrors('Keys tidak valid. Pastikan telah melakukan Register')->withInput();
        }
    }
}
