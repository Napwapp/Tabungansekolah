<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaveController extends Controller
{
    // untuk menampilkan halaman tabungan
   function tabungan() {
    return view('pointakses.user.tabungan');
   }
}
