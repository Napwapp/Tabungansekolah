<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlusController extends Controller
{
    // untuk menampilkan halaman awal tambah saldo 
    function plus() {
        return view('pointakses.user.topup.tambahsaldo');
    }
}
