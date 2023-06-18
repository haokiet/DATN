<?php

namespace App\Http\Controllers;

use App\Models\Hoadon;
use App\Models\Shipper;
use App\Models\Thanhtoan;
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
            ->where('hoadon.is_delete','=',0)
            ->get();
        $hh = null; $tong = 0;
        $i=0;
        $hd2 = DB::table('hoadon')
            ->where('hoadon.trang_thai','=',2)
            ->where('hoadon.is_delete','=',0)
            ->get();

        foreach ($hd2 as $item)
        {
            $hh[$i] = DB::table('hoadon')
                ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
                ->join('users','sanpham.ma_nguoidung','=','users.id')
                ->join('thanhtoan','hoadon.id','=','thanhtoan.ma_hoadon')
                ->where('hoadon.id','=',$item->id)
                ->where('hoadon.trang_thai','=',2)
                ->where('hoadon.is_delete','=',0)
                ->select([
                    'ten_vc',
                    'don_gia_vc',
                    'ma_vanchuyen',
                    'dia_chi_nhan',
                    'ten_nhan',
                    'so_dt_nhan',
                    'thanhtoan.ma_hoadon',
                    'sanpham.ma_nguoidung',
                    'hoadon.trang_thai',
                    'so_luong_mua',
                    'anh_sp',
                    'ten_sp',
                    'so_luong',
                    'gia_goc',
                    'khuyen_mai',
                    'ma_sp',
                    'username',
                    'thanhtoan.trang_thai as thanhtoan'

                ])
                ->get();
            $i++;
        }

        if ($hh !==null)
        {
            $m = 0; $n = 1; $k =0; $s=array(); $s[0]=0; $tong=array();
            foreach ($hh as $t)
            {
                foreach ($t as $v)
                {
                    $s[$n] = $s[$m] + (($v->gia_goc - $v->khuyen_mai)*$v->so_luong_mua + $v->don_gia_vc);
                    $m++; $n++;
                }
                $tong[$k]=$s[$n-1];
                $k++;
                $m = 0; $n = 1; $s[0]=0;
            }
        }

        return view('shipper.index',compact('user','hd','hd2','hh','tong'));
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
        $hh = null; $tong = 0;
        $i=0;
        $hd2 = DB::table('hoadon')
            ->join('shipper','shipper.ma_hoadon','=','hoadon.id')
            ->where('hoadon.trang_thai','=',3)
            ->where('shipper.ma_nguoidung','=',$user->id)
            ->get();
        foreach ($hd2 as $item)
        {
            $hh[$i] = DB::table('hoadon')
                ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
                ->join('thanhtoan','hoadon.id','=','thanhtoan.ma_hoadon')
                ->join('users','sanpham.ma_nguoidung','=','users.id')
                ->where('hoadon.id','=',$item->id)
                ->where('hoadon.trang_thai','=',3)
                ->select([
                    'ten_vc',
                    'don_gia_vc',
                    'ma_vanchuyen',
                    'dia_chi_nhan',
                    'ten_nhan',
                    'so_dt_nhan',
                    'thanhtoan.ma_hoadon',
                    'sanpham.ma_nguoidung',
                    'hoadon.trang_thai',
                    'so_luong_mua',
                    'anh_sp',
                    'ten_sp',
                    'so_luong',
                    'gia_goc',
                    'khuyen_mai',
                    'ma_sp',
                    'username',
                    'thanhtoan.trang_thai as thanhtoan'

                ])
                ->get();
            $i++;
        }
        if ($hh !==null)
        {
            $m = 0; $n = 1; $k =0; $s=array(); $s[0]=0; $tong=array();
            foreach ($hh as $t)
            {
                foreach ($t as $v)
                {
                    $s[$n] = $s[$m] + (($v->gia_goc - $v->khuyen_mai)*$v->so_luong_mua + $v->don_gia_vc);
                    $m++; $n++;
                }
                $tong[$k]=$s[$n-1];
                $k++;
                $m = 0; $n = 1; $s[0]=0;
            }
        }

        return view('shipper.nhan_order',compact('user','hd','hd2','hh','tong'));
    }

    public function cofimRecive($id){
        $hd = Hoadon::find($id);

        $hd->trang_thai=4;
        $hd->save();

        $tt = DB::table('thanhtoan')
            ->where('ma_hoadon','=',$id)->select('*');

        $tt->update(['trang_thai'=>1]);


        return back()->with('thongbao','đã gửi hàng');
    }
    public function moneyAway($id){
        $hd = Hoadon::find($id);
        $hd->trang_thai=5;
        $hd->save();
        return back()->with('thongbao','đã xác nhận trả hàng');
    }
}
