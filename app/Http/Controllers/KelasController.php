<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelasController extends Controller
{
    function kelas () {
        return view('pointakses/user/tabungan_kelas');
    }
}
