<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    // untuk menampilkan halaman profil
    public function profile() {
        // abaikan error load
        $user = Auth::user()->load('tabunganUser'); // Ambil data user yang sedang login

        return view('pointakses/user/profil', compact('user'));
    }
}