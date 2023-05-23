<?php

namespace App\Http\Controllers;

use App\Models\Sanpham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function allSP(){
        $sp=DB::table('sanpham')
            ->where('trang_thai','=','0')
            ->orderByDesc('created_at')
            ->get();
        return view('admin.all_sp',compact('sp'));
    }
    public function duyetSP($id){
        $sp=DB::table('theloai')
            ->join('sanpham','sanpham.ma_theloai','=','theloai.id')
            ->where('sanpham.id','=',$id)
            ->get();

        $nguoidung = User::find($sp[0]->ma_nguoidung);


        $anh=DB::table('photos')->join('sanpham','sanpham.id','=','photos.ma_sp','inner')
            ->where('sanpham.id','=',$id)
            ->select('url')->get();

        $giaban=$sp[0]->gia_goc - $sp[0]->khuyen_mai;

        return view('admin.duyet_sp',compact('sp','nguoidung','anh','giaban'));
    }
    public function confimDuyet($id){
        $sp=Sanpham::find($id);
        $sp->trang_thai=1;
        $sp->save();
        return redirect('/admin');
    }
}
