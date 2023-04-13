<?php

namespace App\Http\Controllers;

use App\Models\Sanpham;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $giaban=array();
        $i=0;
        $sp=Sanpham::all()->where('trang_thai','=',1)
            ->where('so_luong','>',0);
        foreach ($sp as $item)
        {

            $giaban[$i] = $item->gia_goc - $item->khuyen_mai;
            $i++;
        }
//            $gia_goc = DB::table('sanpham')->value('gia_goc');
//            $khuyen_mai = DB::table('sanpham')->value('khuyen_mai');

//            dd($giaban);



        return view('sanpham.index',compact('sp','giaban'));

    }
    public function create()
    {
        return view('nguoidung.create');
    }
}
