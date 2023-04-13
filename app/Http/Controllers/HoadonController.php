<?php

namespace App\Http\Controllers;

use App\Models\Hoadon;
use App\Models\Sanpham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HoadonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function order_sell_all()
    {
        $user = Auth::user();
        $sp = DB::table('sanpham')
            ->join('ct_hoadon','ct_hoadon.ma_sp','=','sanpham.id')
            ->join('users','users.id','=','sanpham.ma_nguoidung')
            ->where('users.id','=',$user->id)
            ->select('ct_hoadon.ma_sp','sanpham.ten_sp','sanpham.id')->groupBy('ct_hoadon.ma_sp')->get();

           $dem=0;
           $num=array();
           $i=0;
           foreach ($sp as $item)
           {
               $hoadon = DB::table('ct_hoadon')
                   ->select('ma_hoadon')->where('ma_sp','=',$item->id)->get();
               foreach ($hoadon as $value)
               {
                   $dem ++;
               }
               $num[$i]=$dem;
               $dem=0;
               $i++;
           }


        return view('hoadon_sell.all_order',compact('num','sp'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Hoadon $hoadon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hoadon $hoadon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hoadon $hoadon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hoadon $hoadon)
    {
        //
    }
}
