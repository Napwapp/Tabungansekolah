<?php

namespace App\Http\Controllers;


use App\Models\DataAnggota as ModelsDataAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;



class DataMahasiswa extends Controller
{
    function index () {
        $data = ModelsDataAnggota::all();
        return view('data_anggota.index', ['data' => $data]);
    }

    function tambah () {
        return view('data_anggota.tambah');
    }

    function edit($id) {
        $data = ModelsDataAnggota::find($id);
        return view ('data_anggota.edit', ['data' => $data]);
    }

    public function hapus(Request $request) {
        ModelsDataAnggota::where('id', $request->id)->delete();
        
        Session::flash('success', 'Berhasil hapus data');
        return redirect('/dataanggota');
    }
}
