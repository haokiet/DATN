<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShipperController extends Controller
{

    public function allOrder()
    {
        $user = Auth::user();

        $hd = DB::table('hoadon')
            ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
            ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
            ->where('hoadon.trang_thai','=',2)
            ->get();
        $hh = array();
        $i=0;
        $hd2 = DB::table('hoadon')
            ->where('hoadon.trang_thai','=',2)
            ->get();

        foreach ($hd2 as $item)
        {
            $hh[$i] = DB::table('hoadon')
                ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
                ->where('hoadon.id','=',$item->id)
                ->where('hoadon.trang_thai','=',2)
                ->get();
            $i++;
        }

        return view('shipper.index',compact('user','hd','hd2','hh'));
    }
}
