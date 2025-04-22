<?php

namespace App\Http\Controllers;


use App\Models\DataAnggota as ModelsDataAnggota;
use App\Models\User;
use App\Models\TabunganUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;

class DataAnggota extends Controller
{
    function index()
    {
        $users = User::where('role', 'user')->orderBy('namalengkap', 'asc')->get(); // get() ditambahkan
        return view('data_anggota.index', ['data' => $users]);
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Role berhasil diperbarui!'
        ]);
    }

    // Search Member
    public function searchUsers(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json([]);
        }

        $results = User::with('tabungan')
            ->where('role', 'user')
            ->where(function ($q) use ($query) {
                $q->where('namalengkap', 'like', '%' . $query . '%')
                    ->orWhere('username', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%');
            })
            ->orderBy('namalengkap', 'asc')
            ->get();

        return response()->json($results);
    }

    public function loadSearch()
    {
        $users = User::with('tabungan')
            ->where('role', 'user')
            ->orderBy('namalengkap', 'asc')
            ->get();

        return response()->json($users);
    }

    public function massDestroy(Request $request)
    {
        $ids = $request->input('ids');

        if (!$ids || !is_array($ids)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada akun yang dipilih.'
            ], 400);
        }

        $users = User::whereIn('id', $ids)->get();

        foreach ($users as $user) {
            $user->delete(); // akan trigger booted() dan hapus relasi
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Akun berhasil dihapus.'
        ]);
    }

    public function tambahAnggota(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namalengkap' => 'required|min:5|max:50',
            'kelas' => [
                'required',
                'regex:/^(X|XI|XII)\s(TBSM 1|TBSM 2|RPL|AKL|OTKP|ATPH|TEI)$/'
            ],
            'username' => 'required|min:5|max:18',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'min:8', 'regex:/\d/'],
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'password.regex' => 'Password harus mengandung minimal satu angka.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

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
                'password' => Hash::make($request->password),
                'gambar' => $nama_gambar,
            ]);

            TabunganUser::create([
                'user_id' => $user->id,
                'id_tabungan' => TabunganUser::generateIdTabungan(),
                'saldo' => 0,
            ]);

            return response()->json(['success' => true, 'message' => 'Anggota berhasil ditambahkan.']);
        } catch (\Throwable $e) {
            Log::error('Gagal menambahkan anggota: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menyimpan data.'], 500);
        }
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');

        // Cek apakah email sudah terdaftar di database
        $exists = DB::table('users')->where('email', $email)->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }
}
