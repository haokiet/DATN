<?php

namespace App\Http\Controllers;

use App\Models\Sanpham;
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
        $sp=DB::table('sanpham')->find($id);
        return view('admin.duyet_sp',compact('sp'));
    }
    public function confimDuyet($id){
        $sp=Sanpham::find($id);
        $sp->trang_thai=1;
        $sp->save();
        return redirect('/admin');
    }
}
