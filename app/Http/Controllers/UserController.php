<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function index(){
        $user = Auth::user(); // Ambil data user yang sedang login
        $idTabungan = $user->tabunganUser->id_tabungan ?? 'ID tabungan tidak tersedia'; // Mengambil id_tabungan dari relasi
        
        return view ('pointakses/user/index', compact('user'));
    }

}
