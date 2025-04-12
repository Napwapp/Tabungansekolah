<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiAlamat;
use App\Models\InformasiKontak;
use App\Models\InformasiEmail;
use App\Models\InformasiSosmed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SetUrlController extends Controller
{
    // Pastikan hanya user yang sudah login yang bisa mengakses controller ini
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan halaman pengaturan (alamat & kontak)
    public function index()
    {
        $alamat = InformasiAlamat::where('user_id', Auth::id())->first();
        $kontaks = InformasiKontak::where('user_id', Auth::id())
            ->orderBy('id_informasi_kontak')
            ->get();
        $emails = InformasiEmail::where('user_id', Auth::id())
            ->orderBy('id_informasi_email')
            ->get();

        // Menambahkan variabel sosial media
        $informasiSosmed = InformasiSosmed::where('nama_anggota', 'anggota_1')->first();
        $informasiSosmed2 = InformasiSosmed::where('nama_anggota', 'anggota_2')->first();
        $informasiSosmed3 = InformasiSosmed::where('nama_anggota', 'anggota_3')->first();

        // Passing variabel ke view
        return view('pointakses.admin.seturl', compact('alamat', 'kontaks', 'emails', 'informasiSosmed', 'informasiSosmed2', 'informasiSosmed3'));
    }

    /* ===============================
       Pengaturan Alamat (sudah ada)
       =============================== */

    public function alamatStore(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
        ]);

        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan ini.');
        }

        if (InformasiAlamat::where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('error', 'Alamat sudah ada, gunakan fitur edit.');
        }

        InformasiAlamat::create([
            'user_id' => Auth::id(),
            'alamat'  => $request->alamat,
        ]);

        return redirect()->back()->with('success', 'Alamat berhasil ditambahkan.');
    }

    public function alamatUpdate(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
        ]);

        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan ini.');
        }

        $alamat = InformasiAlamat::where('user_id', Auth::id())->first();
        if (!$alamat) {
            return redirect()->back()->with('error', 'Alamat tidak ditemukan untuk diperbarui.');
        }

        $alamat->update([
            'alamat' => $request->alamat,
        ]);

        return redirect()->back()->with('success', 'Alamat berhasil diperbarui.');
    }

    /* ===============================
       Pengaturan Kontak
       =============================== */

    // Fungsi untuk menambahkan kontak baru
    public function kontakStore(Request $request)
    {
        // Validasi input nomor
        $request->validate([
            'nomor' => [
                'required',
                'regex:/^8\d{10,11}$/',
                'min:11',
                'max:12'
            ],
        ]);

        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Anda tidak memiliki izin untuk melakukan ini.'], 403);
        }

        // Jika form mengirimkan id_informasi_kontak (dari list-kontak), gunakan slot itu
        if ($request->has('id_informasi_kontak')) {
            $slot = $request->input('id_informasi_kontak');
        } else {
            // Jika form tambah kontak, cari slot kosong otomatis
            $kontaks = InformasiKontak::where('user_id', Auth::id())
                ->orderBy('id_informasi_kontak')
                ->get();
            $slot = null;
            for ($i = 1; $i <= 3; $i++) {
                if (!$kontaks->contains('id_informasi_kontak', $i)) {
                    $slot = $i;
                    break;
                }
            }
            if (!$slot) {
                return response()->json(['error' => 'Tidak ada slot kosong.'], 400);
            }
        }

        InformasiKontak::create([
            'user_id' => Auth::id(),
            'nomor' => '+62' . $request->input('nomor'),
            'id_informasi_kontak' => $slot,
        ]);

        return response()->json([
            'success' => 'Nomor berhasil ditambahkan di slot ' . $slot,
            'nomor' => $request['nomor']
        ]);
    }

    public function kontakUpdate(Request $request)
    {
        // Validasi input nomor dan slot
        $request->validate([
            'id_informasi_kontak' => 'required|integer|min:1|max:3',
            'nomor' => [
                'required',
                'regex:/^8\d{10,11}$/',
                'min:11',
                'max:12'
            ],
        ]);

        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Anda tidak memiliki izin untuk melakukan ini.'], 403);
        }

        // Cari data nomor berdasarkan user_id dan slot
        $kontak = InformasiKontak::where('user_id', Auth::id())
            ->where('id_informasi_kontak', $request->input('id_informasi_kontak'))
            ->first();

        if (!$kontak) {
            return response()->json(['error' => 'Nomor tidak ditemukan untuk slot tersebut.'], 404);
        }

        $kontak->update([
            'nomor' => '+62' . $request->input('nomor'),
        ]);

        return response()->json([
            'success' => 'Nomor di slot ' . $request->input('id_informasi_kontak') . ' berhasil diperbarui.',
            'nomor' => $request->input('nomor') // Kirimkan nomor terbaru
        ]);
    }

    public function checkNomor(Request $request)
    {
        $nomor = '+62' . $request->input('nomor');
        $exists = DB::table('informasi_kontak')->where('nomor', $nomor)->exists();
        return response()->json(['exists' => $exists]);
    }

    // Bagian email
    public function emailStore(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                'unique:informasi_email,email',
                'min:15',
                'max:100',
                function ($attribute, $value, $fail) {
                    // Validasi domain email
                    if (!str_ends_with($value, '@gmail.com')) {
                        $fail('Email harus menggunakan domain @gmail.com');
                    }
                },
            ],
        ]);

        try {
            $emailId = $request->input('id_informasi_email');

            if ($emailId) {
                $slot = $emailId;
            } else {
                $emails = InformasiEmail::where('user_id', Auth::id())
                    ->orderBy('id_informasi_email')
                    ->pluck('id_informasi_email')
                    ->toArray();

                $slot = null;
                for ($i = 1; $i <= 3; $i++) {
                    if (!in_array($i, $emails)) {
                        $slot = $i;
                        break;
                    }
                }

                if (!$slot) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Tidak ada slot kosong untuk email.',
                    ], 400);
                }
            }

            // Menyimpan email yang valid
            InformasiEmail::create([
                'id_informasi_email' => $slot,
                'email' => $validated['email'],
                'user_id' => Auth::id(),
            ]);

            // Response saat berhasil
            return response()->json([
                'success' => true,
                'message' => 'Email berhasil ditambahkan!',
                'slot' => $slot,
                'email' => $validated['email'],
            ], 200);
        } catch (\Exception $e) {
            // Response jika ada error
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function emailUpdate(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
                'min:15',
                'max:100',
                'unique:informasi_email,email'
            ],
            'id_informasi_email' => 'required|integer|in:1,2,3',
        ], [
            'email.regex' => 'Email harus berakhiran @gmail.com dan hanya mengandung karakter yang valid.'
        ]);

        $emailData = InformasiEmail::find($validated['id_informasi_email']);

        if ($emailData) {
            $emailData->update([
                'email' => $validated['email'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Email berhasil diperbarui!',
                'email' => $validated['email'],
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Email tidak ditemukan untuk diperbarui.',
        ]);
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');

        // Cek apakah email sudah terdaftar di database
        $exists = DB::table('informasi_email')->where('email', $email)->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }

    // bagian set url sosmed
    public function updateAnggota1(Request $request)
    {
        $request->validate(InformasiSosmed::rules(), InformasiSosmed::messages());

        $sosmed = InformasiSosmed::where('nama_anggota', 'anggota_1')->first();

        if ($sosmed) {
            $sosmed->update([
                'github' => $request->github,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
            ]);
        } else {
            InformasiSosmed::create([
                'nama_anggota' => 'anggota_1',
                'github' => $request->github,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
            ]);
        }

        return response()->json([
            'message' => 'Data sosial media berhasil diperbarui.',
        ]);
    }

    public function updateAnggota2(Request $request)
    {
        $request->validate(InformasiSosmed::rules(), InformasiSosmed::messages());

        $sosmed = InformasiSosmed::where('nama_anggota', 'anggota_2')->first();

        if ($sosmed) {
            $sosmed->update([
                'github' => $request->github,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
            ]);
        } else {
            InformasiSosmed::create([
                'nama_anggota' => 'anggota_2',
                'github' => $request->github,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
            ]);
        }

        return response()->json([
            'message' => 'Data sosial media berhasil diperbarui.',
        ]);
    }

    public function updateAnggota3(Request $request)
    {
        $request->validate(InformasiSosmed::rules(), InformasiSosmed::messages());

        $sosmed = InformasiSosmed::where('nama_anggota', 'anggota_3')->first();

        if ($sosmed) {
            $sosmed->update([
                'github' => $request->github,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
            ]);
        } else {
            InformasiSosmed::create([
                'nama_anggota' => 'anggota_3',
                'github' => $request->github,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
            ]);
        }

        return response()->json([
            'message' => 'Data sosial media berhasil diperbarui.',
        ]);
    }

    public function checkGithub(Request $request)
    {
        $githubUrl = $request->input('github'); // Mendapatkan URL GitHub dari request

        // Cek apakah GitHub sudah terdaftar di database
        $exists = DB::table('informasi_sosmed')->where('github', $githubUrl)->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }

    public function checkInstagram(Request $request)
    {
        $instagramUrl = $request->input('instagram'); // Mendapatkan URL Instagram dari request

        // Cek apakah Instagram sudah terdaftar di database
        $exists = DB::table('informasi_sosmed')->where('instagram', $instagramUrl)->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }

    public function checkLinkedin(Request $request)
    {
        $linkedinUrl = $request->input('linkedin'); // Mendapatkan URL LinkedIn dari request

        // Cek apakah LinkedIn sudah terdaftar di database
        $exists = DB::table('informasi_sosmed')->where('linkedin', $linkedinUrl)->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }
}
