<?php

namespace App\Http\Controllers;

use App\Models\CT_Hoadon;
use App\Models\Hoadon;
use App\Models\Sanpham;
use App\Models\User;
use App\Models\Vanchuyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CTHoadonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        $ct_hd= DB::table('ct_hoadon')
            ->join('hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
            ->where('hoadon.ma_nguoidung','=',$user->id)
            ->where('hoadon.trang_thai','=',0)
            ->get();
        $vanchuyen = Vanchuyen::all();
//        $hd = DB::table('hoadon')
//            ->where('ma_nguoidung','=',$user->id)
//            ->where('trang_thai','=','0')
//            ->select('id')->get();
//        $hd = $hd[0];
//        $money=array();
//        $i=0;
//        if ()
//        foreach ($ct_hd as $value)
//        {
//            $money[$i]=($value->gia_goc - $value->khuyen_mai)* $value->so_luong_mua;
//            $i++;
//        }
        return view('order.index',compact('ct_hd','vanchuyen'));
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
   public function gioHang(Request $request,$id)
    {
        $user=Auth::user();
        $hd=DB::table('hoadon')
            ->where('trang_thai','=',0)
            ->where('ma_nguoidung','=',$user->id)->get();
        $sp=Sanpham::find($id);
        $dem=count($hd);


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

        $hd2 = DB::table('hoadon')
            ->where('trang_thai','=',0)
            ->where('ma_nguoidung','=',$user->id)->select('id')->get();

            $count_hd = count($hd2);
            $ct_hd = DB::table('ct_hoadon')
                ->join('hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
                ->where('ma_hoadon','=',$hd2[0]->id)->get();
            $count_ct_hd = count($ct_hd);

            if($count_hd ===1)
            {
                if ($count_ct_hd===0)
                {
                    CT_Hoadon::create([
                        'ma_hoadon' => $hd2[0]->id,
                        'ma_sp' => $sp->id,
                        'so_luong_mua' => $request->so_luong
                    ]);
                    return back()->with('thongbao', 'đã thêm vào giỏ hàng');
                }
                else
                {
                    foreach ($ct_hd as $n) {
                        if ($n->ma_hoadon ===$hd2[0]->id)
                        {
                            if($n->ma_sp === $sp->id )
                            {

                                DB::table('ct_hoadon')
                                    ->where('ma_hoadon','=',$hd2[0]->id)
                                    ->where('ma_sp','=',$sp->id)
                                    ->update(['so_luong_mua'=>($n->so_luong_mua + $request->so_luong)]);
                                return back()->with('thongbao', 'đã thêm '. $request->so_luong. ' vào giỏ hàng');
                            }
                            else
                            {
                                CT_Hoadon::create([
                                    'ma_hoadon' => $hd2[0]->id,
                                    'ma_sp' => $sp->id,
                                    'so_luong_mua' => $request->so_luong
                                ]);
                                return back()->with('thongbao', 'đã thêm '. $request->so_luong. ' vào giỏ hàng');
                            }
                        }

                    }
                }

            }
    }


    /**
     * Display the specified resource.
     */
    public function show(CT_Hoadon $cT_Hoadon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CT_Hoadon $cT_Hoadon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CT_Hoadon $cT_Hoadon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_giohang($id)
    {

        $ct_d = DB::table('ct_hoadon')->where('ma_sp','=',$id);
        $ct_d->delete();
        return redirect('/giohang');
    }
}
