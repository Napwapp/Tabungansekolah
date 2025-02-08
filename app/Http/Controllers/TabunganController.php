<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use Illuminate\Http\Request;

class TabunganController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'saldo' => 'required|numberic'
        ]);

        Tabungan::create($request->all());

        return redirect()->back()->with('succes', 'Tabungan berhasil ditambahkan');
    }

    public function index($keals_id)
    {
        $tabungans = Tabungan::where('kelas_id', $keals_id)->get();
        return view('pointakses.admin.tabungan-kelas-admin', compact('tabungnans'));
    }
}
