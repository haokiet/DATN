<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NguoidungController;
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




Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::resource('sanpham',\App\Http\Controllers\SanphamController::class);
Route::resource('nguoidung',\App\Http\Controllers\NguoidungController::class);
Route::post('/registerhaha',[\App\Http\Controllers\NguoidungController::class,'register'])->name('register');


Route::get('/active/{user}/{token}',[\App\Http\Controllers\NguoidungController::class,'active'])->name('nguoidung.active');
Route::get('/login',[NguoidungController::class,'login'])->name('login');
Route::post('/login_check',[NguoidungController::class,'check_login'])->name('check_login');
Route::get('/sell',[NguoidungController::class,'sell_regis'])->name('sell_regis');
Route::get('/logout',[NguoidungController::class,'logout'])->name('logout');
