<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RiwayatController extends Controller
{
    // untuk menampilkan halaman riwayat
    function riwayat () {
        $user = Auth::user()->load('tabunganUser'); // Ambil data user yang sedang login

        return view('pointakses.user.riwayat');
    }
}
