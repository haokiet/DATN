<?php

namespace App\Http\Controllers;

use App\Models\Sanpham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $giaban=array();
        $i=0;
        $sp=DB::table('sanpham')
            ->where('trang_thai','=',1)
            ->where('so_luong','>',0)
            ->get();
        $j = 0;
        $sp2 ="";

        foreach ($sp as $item)
        {
            $u = DB::table('users')
                ->join('sanpham','sanpham.ma_nguoidung','=','users.id')
                ->where('users.is_delete','=',1)
                ->where('users.id','=',$item->ma_nguoidung)
                ->get();
            $sp2= $u;
            $j++;
        }
        foreach ($sp2 as $item)
        {
            $giaban[$i] = $item->gia_goc - $item->khuyen_mai;
            $i++;
        }
//            $gia_goc = DB::table('sanpham')->value('gia_goc');
//            $khuyen_mai = DB::table('sanpham')->value('khuyen_mai');

//            dd($giaban);


        return view('sanpham.index',compact('sp2','giaban'));

    }
    public function create()
    {
        return view('nguoidung.create');
    }
}
