<?php

namespace App\Http\Controllers;

use App\Models\CT_Hoadon;
use App\Models\Hoadon;
use App\Models\Sanpham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CTHoadonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $hd=Hoadon::all();
        $sp=Sanpham::find($id);
        $dem=0;

            foreach ($hd as $value)
            {
                if($value->trang_thai ===0 & $value->ma_nguoidung === $user->id)
                {
                    $dem++;
                }
            }
            if ($dem ===0)
            {
                $hoadon=Hoadon::create([
                    'ma_nguoidung'=>$user->id,
                    'dia_chi_nhan'=>$user->dia_chi,
                    'ten_nhan'=>$user->username,
                    'so_dt_nhan'=>$user->so_dt
                ]);
            }
        $hd2=Hoadon::all();
        foreach ($hd2 as $item)
        {
            if($item->trang_thai ===0 & $item->ma_nguoidung ===$user->id)
            {
                CT_Hoadon::create([
                    'ma_hoadon'=>$item->id,
                    'ma_sp'=>$sp->id,
                    'so_luong'=>$request->so_luong
                ]);
            }
        }
        return redirect('/');
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
    public function destroy(CT_Hoadon $cT_Hoadon)
    {
        //
    }
}
