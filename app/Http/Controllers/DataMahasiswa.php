<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataMahasiswa extends Controller
{
    function index () {
        return view('data_anggota.index');
    }
}
