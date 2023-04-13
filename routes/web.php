<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NguoidungController;
use App\Http\Controllers\HoadonController;
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

//
//Route::middleware('guest')->group(function (){
    Route::post('/registerhaha',[\App\Http\Controllers\NguoidungController::class,'register'])->name('register');
    Route::get('/login',[NguoidungController::class,'login'])->name('login');
//});

Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::resource('sanpham',\App\Http\Controllers\SanphamController::class);
Route::resource('nguoidung',\App\Http\Controllers\NguoidungController::class);
//
//Route::middleware('auth')->group(function (){
    Route::get('/active/{user}/{token}',[\App\Http\Controllers\NguoidungController::class,'active'])->name('nguoidung.active');

    Route::post('/login_check',[NguoidungController::class,'check_login'])->name('check_login');

    Route::get('/logout',[NguoidungController::class,'logout'])->name('logout');
//});



Route::middleware([
    'auth'
])->group(function (){
    Route::get('/sell',[NguoidungController::class,'sell_regis'])->name('sell_home');
    Route::get('/sell/all-sp',[SanphamController::class,'index'])->name('sell-index-all');
    Route::get('/sell/all-sp-not',[SanphamController::class,'index2'])->name('sell-index-notduyet');
    Route::get('/sell/all-sp-hethang',[SanphamController::class,'index3'])->name('sell-index-hethang');
    Route::get('/sell/all-sp-delete',[SanphamController::class,'index4'])->name('sell-index-delete');
    Route::get('/sell/create-sp',[SanphamController::class,'create'])->name('sell_create_sp');
    Route::post('/luusp',[SanphamController::class,'store'])->name('store');
    Route::get('/sell/order-all',[HoadonController::class,'order_sell_all'])->name('order_sell_all');
    Route::get('/sell/edit/{id}',[SanphamController::class,'edit'])->name('edit_sell_sp');
    Route::post('/sell/update/{id}',[SanphamController::class,'update'])->name('update');
    Route::get('/sell/delete/{id}',[SanphamController::class,'destroy'])->name('delet');
});
