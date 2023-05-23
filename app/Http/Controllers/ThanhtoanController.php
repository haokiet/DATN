<?php

namespace App\Http\Controllers;

use App\Models\CT_Hoadon;
use App\Models\Hoadon;
use App\Models\Phuongthuc;
use App\Models\Thanhtoan;
use App\Models\Vanchuyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class ThanhtoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function view(Request $request)
    {

        $user = Auth::user();
        $ct_hdd = array();
        $i = 0;

        if ($request->id_sp !==null)
        {
            $hdd2 = DB::table('hoadon')
                ->where('ma_nguoidung','=',$user->id)
                ->where('trang_thai','=','0')
                ->get();

            $dem=count($hdd2);

            if ($dem ===0)
            {
                Hoadon::create([
                    'ma_nguoidung'=>$user->id,
                    'dia_chi_nhan'=>$user->dia_chi,
                    'ten_nhan'=>$user->username,
                    'so_dt_nhan'=>$user->so_dt,
                    'ma_van_chuyen'=>1
                ]);
            }

            $hdd = DB::table('hoadon')
                ->where('ma_nguoidung','=',$user->id)
                ->where('trang_thai','=','0')
                ->get();

            $k = $request->id_sp + 0;
            $ct = DB::table('ct_hoadon')
                ->where('ma_hoadon','=',$hdd[0]->id)
                ->where('ma_sp','=',$k)->get();
               if(!isset($ct[0]))
               {
                   CT_Hoadon::create([
                       'ma_hoadon'=>$hdd[0]->id,
                       'ma_sp'=>$k,
                       'so_luong_mua'=>$request->so_luong
                   ]);
               }

            $ct_hdd[$i] = DB::table('ct_hoadon')
                ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                ->join('users','users.id','=','sanpham.ma_nguoidung')
                ->join('hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
                ->where('ct_hoadon.ma_sp','=',$k)
                ->where('ct_hoadon.ma_hoadon','=',$hdd[0]->id)
                ->where('hoadon.trang_thai','=',0)
                ->get();


        }
        else
        {
            $hd = DB::table('hoadon')
                ->where('ma_nguoidung','=',$user->id)
                ->where('trang_thai','=',0)
                ->get();

            foreach ($request->checkbox as $item)
            {
                $ct_hdd[$i] = DB::table('ct_hoadon')
                    ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                    ->join('users','users.id','=','sanpham.ma_nguoidung')
                    ->join('hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
                    ->where('ct_hoadon.ma_sp','=',$item)
                    ->where('ct_hoadon.ma_hoadon','=',$hd[0]->id)
                    ->where('hoadon.trang_thai','=',0)
                    ->get();
                $i++;
            }
        }






        $tong = 0;
        $vanchuyen = Vanchuyen::all();
        $phuongthuc = Phuongthuc::all();
//        foreach ($ct_hdd as $value)
//        {
//            $tong = $tong + (($value->gia_goc - $value->khuyen_mai)*$value->so_luong_mua);
//        }
//        $tong_all = $tong + $vanchuyen->don_gia_vc;
        return view('thanhtoan.index',compact('ct_hdd','vanchuyen','phuongthuc','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function sauKhiNhanHang(Request $request)
    {
        $user =Auth::user();
        $hd = Hoadon::create([
            'ma_nguoidung'=>$user->id,
            'ma_vanchuyen'=>$request->idvc,
            'dia_chi_nhan'=>$request->dia_chi_nhan,
            'ten_nhan'=>$request->ten_nhan,
            'trang_thai'=>1,
            'so_dt_nhan'=>$request->so_dt_nhan
        ]);
        $i=0;
        foreach ($request->idsp as $item)
        {
            CT_Hoadon::create([
                'ma_hoadon'=>$hd->id,
                'ma_sp'=>$item,
                'so_luong_mua'=>$request->slm[$i]
            ]);
            $db = DB::table('ct_hoadon')
                ->join('hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                ->where('hoadon.id','=',$request->idhd)
                ->where('ct_hoadon.ma_sp','=',$item)
                ->delete();
            $i++;
        }
        Thanhtoan::create([
            'ma_hoadon'=>$hd->id,
            'ma_phuongthuc'=>$request->pt,
            'tong_tien'=>$request->tong_tien
        ]);
        return redirect('/');
    }
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Thanhtoan $thanhtoan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thanhtoan $thanhtoan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thanhtoan $thanhtoan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thanhtoan $thanhtoan)
    {
        //
    }
}
