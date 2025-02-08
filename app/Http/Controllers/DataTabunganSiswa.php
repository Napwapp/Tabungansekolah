<?php

namespace App\Http\Controllers;

use App\Models\TabunganUser;
use Illuminate\Http\Request;

class DataTabunganSiswa extends Controller
{
    public function index()
    {
        $tabungans = TabunganUser::all();
        return view('pointakses.admin.tabungan-kelas-admin', compact('tabungans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'nominal' => 'required|numeric',
        ]);
        
        TabunganUser::create($request->all());

        return redirect()->route('');
    }
}
