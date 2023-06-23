<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NguoidungController;
use App\Http\Controllers\HoadonController;
use App\Http\Controllers\CTHoadonController;
use App\Http\Controllers\ThanhtoanController;
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
    'auth',
    'user'
])->group(function (){
    Route::get('/sell',[NguoidungController::class,'sell_regis'])->name('sell_home');
    Route::get('/sell/all-sp',[SanphamController::class,'index'])->name('sell-index-all');
    Route::get('/sell/all-sp-not',[SanphamController::class,'index2'])->name('sell-index-notduyet');
    Route::get('/sell/all-sp-hethang',[SanphamController::class,'index3'])->name('sell-index-hethang');
    Route::get('/sell/all-sp-delete',[SanphamController::class,'index4'])->name('sell-index-delete');
    Route::get('/sell/create-sp',[SanphamController::class,'create'])->name('sell_create_sp');
    Route::post('/luusp',[SanphamController::class,'store'])->name('store');
    Route::get('/sell/order-all',[HoadonController::class,'order_sell_all'])->name('order_sell_all');
    Route::get('/sell/order-wait',[HoadonController::class,'order_sell_wait'])->name('order_sell_wait');
    Route::get('/sell/order-giving',[HoadonController::class,'order_sell_giving'])->name('order_sell_giving');
    Route::get('/sell/order-gave',[HoadonController::class,'order_sell_gave'])->name('order_sell_gave');
    Route::get('/sell/order-delete',[HoadonController::class,'order_sell_delete'])->name('order_sell_delete');
    Route::get('/sell/order-money_away',[HoadonController::class,'order_sell_moneyaway'])->name('order_sell_money_away');
    Route::get('/sell/edit/{id}',[SanphamController::class,'edit'])->name('edit_sell_sp');
    Route::post('/sell/update/{id}',[SanphamController::class,'update'])->name('update');
    Route::get('/sell/delete/{id}',[SanphamController::class,'destroy'])->name('delet');
    Route::get('/sell/up_shop',[NguoidungController::class,'up_shop'])->name('up');
    Route::post('/giohang/{id}',[CTHoadonController::class,'gioHang'])->name('giohang');
    Route::get('/giohang',[CTHoadonController::class,'index'])->name('index_giohang');
    Route::get('/delete/{id}',[CTHoadonController::class,'delete_giohang'])->name('delete-giohang');
    Route::post('/thanhtoan/view',[ThanhtoanController::class,'view'])->name('thanhtoan-index');
    Route::post('/thanhtoan/view1',[ThanhtoanController::class,'thanhtoan1'])->name('thanhtoan-index1');

    Route::post('/thanhtoan/saukhinhanhang',[ThanhtoanController::class,'sauKhiNhanHang'])->name('thanhtoan-sknh');
    Route::get('/order/deatil_wait/{id}',[HoadonController::class,'showWait'])->name('show-wait');
    Route::get('/order/deatil_giving/{id}',[HoadonController::class,'showGiving'])->name('show-giving');
    Route::get('/order/deatil_all/{id}',[HoadonController::class,'showall'])->name('show-all');
    Route::get('/order/deatil_gave/{id}',[HoadonController::class,'showGave'])->name('show-gave');
    Route::get('/order/deatil_away/{id}',[HoadonController::class,'showAway'])->name('show-away');
    Route::get('/order/deatil_wait_buy',[HoadonController::class,'buyshowWait'])->name('buy_show-wait');
    Route::get('/order/confim_wait/{id}',[HoadonController::class,'confimWait'])->name('confim-wait');
    Route::get('/order/delete/{id}',[HoadonController::class,'deleteWait'])->name('huy_xacnhan');

    Route::view('profile','nguoidung.profile')->name('profile_user');
    Route::post('/up_user',[NguoidungController::class,'updateUser'])->name('up_user');

    Route::get('/danhgia',[\App\Http\Controllers\BinhluanController::class,'index'])->name('danhgia');
    Route::post('thanhtoan/momo',[ThanhtoanController::class,'momo'])->name('momo');

    Route::view('/changepass','nguoidung.chanepass')->name('chane');
    Route::post('/change',[NguoidungController::class,'chanePass'])->name('chanePass');

    Route::get('/sell/giaohang',[HoadonController::class,'Giaohang'])->name('giaohang');
    Route::get('/sell/detail-giaohang/{id}',[HoadonController::class,'detailGiaohang'])->name('detail-giaohang');
    Route::get('/sell/exportPDF/{id}',[\App\Http\Controllers\PDFControllerphp::class,'exportPDF'])->name('exportPDF');



    Route::get('/confimGiaohang/{id}',[HoadonController::class,'confimGiaohang'])->name('confgiaohang');

});
Route::get('/show_user/{id}',[NguoidungController::class,'showUser'])->name('show_user');

Route::middleware([
    'shipper'
])->group(function () {
    Route::get('/shipper', [\App\Http\Controllers\ShipperController::class, 'allOrder'])->name('shipper-all-order');
    Route::get('/shipper/danhan', [\App\Http\Controllers\ShipperController::class, 'recivedOrder'])->name('shipper-resive-order');
    Route::get('/shipper/dagui/{id}', [\App\Http\Controllers\ShipperController::class, 'cofimRecive'])->name('shipper-confimresive-order');
    Route::get('/shipper/{id}', [\App\Http\Controllers\ShipperController::class, 'comFimOrder'])->name('shipper-confim-order');
    Route::get('/shipper/trahang/{id}', [\App\Http\Controllers\ShipperController::class, 'moneyAway'])->name('trahang');
});
Route::middleware([
    'admin'
])->group(function (){
    Route::get('/admin',[\App\Http\Controllers\AdminController::class,'allSP'])->name('admin_all');
    Route::get('/admin/chitiet/{id}',[\App\Http\Controllers\AdminController::class,'duyetSP'])->name('duyet_sp');
    Route::get('/admin/duyet/{id}',[\App\Http\Controllers\AdminController::class,'confimDuyet'])->name('duyet_confim');
    Route::get('/admin/all_sp',[\App\Http\Controllers\AdminController::class,'SP'])->name('all_sp_admin');
    Route::get('/admin/chitiet_user/{id}',[\App\Http\Controllers\AdminController::class,'chiTiet'])->name('chiTiet_user');
    Route::get('/admin/all_users',[\App\Http\Controllers\AdminController::class,'all_user'])->name('all_users_admin');
    Route::post('/admin/update_user/{id}',[\App\Http\Controllers\AdminController::class,'updateUser'])->name('update_users_admin');
    Route::get('/admin/delete_user/{id}',[\App\Http\Controllers\AdminController::class,'deleteUser'])->name('delete_user_admin');
    Route::get('/admin/create_user',[\App\Http\Controllers\AdminController::class,'createUser'])->name('create_user_admin');
    Route::post('/admin/store_user',[\App\Http\Controllers\AdminController::class,'storeUser'])->name('store_user_admin');
    Route::get('/admin/all_vanchuyen',[\App\Http\Controllers\AdminController::class,'adminVanchuyen'])->name('adminVanchuyen');
    Route::post('/admin/them_vanchuyen',[\App\Http\Controllers\AdminController::class,'themVC'])->name('themVC');
    Route::get('/admin/xoa_vanchuyen/{id}',[\App\Http\Controllers\AdminController::class,'xoaVC'])->name('xoaVC');
    Route::post('/admin/update_vanchuyen/{id}',[\App\Http\Controllers\AdminController::class,'updateVC'])->name('updateVC');
    Route::get('/admin/all_theloai',[\App\Http\Controllers\AdminController::class,'adminTheloai'])->name('adminTheloai');
    Route::post('/admin/them_theloai',[\App\Http\Controllers\AdminController::class,'themTL'])->name('themTL');
    Route::get('/admin/xoa_theloai/{id}',[\App\Http\Controllers\AdminController::class,'xoaTL'])->name('xoaTL');
    Route::post('/admin/update_theloai/{id}',[\App\Http\Controllers\AdminController::class,'updateTL'])->name('updateTL');
    Route::post('/admin/deleteSP/{id}',[\App\Http\Controllers\AdminController::class,'vipham'])->name('vipham');


});



// xóa file trong gg drive
Route::get('list', function() {
    $dir = '/';
    $recursive = true; // Có lấy file trong các thư mục con không?
    $contents = collect(Storage::disk('google')->listContents($dir, $recursive));
    $r = $contents->where('path','=','image1683311809.jpg')->first();

//    Storage::disk('google')->delete($r['path']);
    dd($r);
});



Route::get('/Timkiem',[SanphamController::class,'timKiem'])->name('timkiem');




Route::view('/kkkk','kkk');

Route::get('/loinhuan',[HoadonController::class,'tongLoinhuan'])->name('loinhuan');
