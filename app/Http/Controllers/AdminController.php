<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index() {
        return view('pointakses/admin/index');
    }
    public function adminprofil()
    {
        $admin = auth()->user(); //Mengambil data admin yang sedang login
        return view('pointakses.admin.profiladmin', compact('admin'));
    }
}
