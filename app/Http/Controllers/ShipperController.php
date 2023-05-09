<?php

namespace App\Http\Controllers;

use App\Models\Hoadon;
use App\Models\Shipper;
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
        $hh = null;
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

    public function comFimOrder($id)
    {
        $hd = Hoadon::find($id);
        $hd->trang_thai=3;
        $hd->save();
        $user = Auth::user();
        Shipper::create([
            'ma_nguoidung'=>$user->id,
            'ma_hoadon'=>$id
        ]);

        return back()->with('ketqua','đã nhận hóa đơn');

    }

    public function recivedOrder()
    {
        $user = Auth::user();

        $hd = DB::table('hoadon')
            ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
            ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
            ->where('hoadon.trang_thai','=',3)
            ->get();
        $hh = null;
        $i=0;
        $hd2 = DB::table('hoadon')
            ->where('hoadon.trang_thai','=',3)
            ->get();

        foreach ($hd2 as $item)
        {
            $hh[$i] = DB::table('hoadon')
                ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
                ->where('hoadon.id','=',$item->id)
                ->where('hoadon.trang_thai','=',3)
                ->get();
            $i++;
        }

        return view('shipper.nhan_order',compact('user','hd','hd2','hh'));
    }

    public function cofimRecive($id){
        $hd = Hoadon::find($id);
        $hd->trang_thai=4;
        $hd->save();
        return back()->with('thongbao','đã gửi hàng');
    }
    public function moneyAway($id){
        $hd = Hoadon::find($id);
        $hd->trang_thai=5;
        $hd->save();
        return back()->with('thongbao','đã xác nhận trả hàng');
    }
}
