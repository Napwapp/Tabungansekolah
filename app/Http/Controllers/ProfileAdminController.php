<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileAdminController extends Controller
{
    function profiladmin() {
        $admin = auth()->user(); //Mengambil data admin yang sedang login
        return view('pointakses.admin.profiladmin', compact('admin'));
    }
}
