<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    // untuk menampilkan halaman profil
    public function profile() {
        $user = Auth::user(); // Ambil data user yang sedang login
        return view('pointakses/user/profil', compact('user'));
    }
}