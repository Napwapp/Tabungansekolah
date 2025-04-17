<?php

namespace App\Http\Controllers;


use App\Models\DataAnggota as ModelsDataAnggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;

class DataAnggota extends Controller
{
    function index()
    {
        $data = User::all();
        return view('data_anggota.index', ['data' => $data]);
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Role berhasil diperbarui');
    }
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            $user->delete(); // akan otomatis trigger penghapusan data terkait dari model User

            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil dihapus beserta data terkait.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
