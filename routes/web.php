<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'landingpage/landingpage');

// untuk login
Route::get('/sesi',[AuthController::class,'index'])->name('auth');
Route::post('/sesi',[AuthController::class,'login']);

// untuk register
Route::get('/reg',[AuthController::class,'create'])->name('registrasi');
Route::post('/reg',[AuthController::class,'register'])->name('registrasi.post');

// route admin dan user
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/user', [UserController::class, 'index'])->name('user');

// route user (untuk logikanya)
// Route::get('/user', [UserController::class, 'dashboard']);

// route profil 
Route::get('/profile', [ProfileController::class, 'profile'])->name( 'profile');
Route::get('/profile', [ProfileController::class, 'profil']);
