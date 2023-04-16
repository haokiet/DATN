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
            ->select('ct_hoadon.ma_sp','sanpham.ten_sp','sanpham.id')->groupBy('ct_hoadon.ma_sp')
            ->paginate(9);

           $dem=0;
           $num=array();
           $i=0;
           $count=0;
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
               $count++;
               $i++;
           }


        return view('hoadon_sell.all_order',compact('num','sp','count'));
    }
    // cho duyet
    public function order_sell_wait()
    {
        $user = Auth::user();
        $sp = DB::table('sanpham')
            ->join('ct_hoadon','ct_hoadon.ma_sp','=','sanpham.id')
            ->join('users','users.id','=','sanpham.ma_nguoidung')
            ->join('hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
            ->where('users.id','=',$user->id)
            ->where('hoadon.trang_thai','=','1')
            ->select('ct_hoadon.ma_sp','sanpham.ten_sp','sanpham.id')->groupBy('ct_hoadon.ma_sp')
            ->paginate(9);
        $dem=0;
        $count=0;
        $num=array();
        $i=0;
        foreach ($sp as $item)
        {
            $hoadon = DB::table('ct_hoadon')
                ->select('ma_hoadon')
                ->where('ma_sp','=',$item->id)->get();
            foreach ($hoadon as $value)
            {
                $dem ++;
            }
            $num[$i]=$dem;
            $dem=0;
            $count++;
            $i++;

        }


        return view('hoadon_sell.wait_order_sell',compact('num','sp','count'));
    }
    // dang giao
    public function order_sell_giving()
    {
        $user = Auth::user();
        $sp = DB::table('sanpham')
            ->join('ct_hoadon','ct_hoadon.ma_sp','=','sanpham.id')
            ->join('users','users.id','=','sanpham.ma_nguoidung')
            ->join('hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
            ->where('users.id','=',$user->id)
            ->where('hoadon.trang_thai','=','2')
            ->select('ct_hoadon.ma_sp','sanpham.ten_sp','sanpham.id')->groupBy('ct_hoadon.ma_sp')
            ->paginate(9);
        $dem=0;
        $count=0;
        $num=array();
        $i=0;
        foreach ($sp as $item)
        {
            $hoadon = DB::table('ct_hoadon')
                ->select('ma_hoadon')
                ->where('ma_sp','=',$item->id)->get();
            foreach ($hoadon as $value)
            {
                $dem ++;
            }
            $num[$i]=$dem;
            $dem=0;
            $count++;
            $i++;

        }


        return view('hoadon_sell.giving_order',compact('num','sp','count'));
    }
    public function order_sell_gave()
    {
        $user = Auth::user();
        $sp = DB::table('sanpham')
            ->join('ct_hoadon','ct_hoadon.ma_sp','=','sanpham.id')
            ->join('users','users.id','=','sanpham.ma_nguoidung')
            ->join('hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
            ->where('users.id','=',$user->id)
            ->where('hoadon.trang_thai','=','3')
            ->select('ct_hoadon.ma_sp','sanpham.ten_sp','sanpham.id')->groupBy('ct_hoadon.ma_sp')
            ->paginate(9);
        $dem=0;
        $count=0;
        $num=array();
        $i=0;
        foreach ($sp as $item)
        {
            $hoadon = DB::table('ct_hoadon')
                ->select('ma_hoadon')
                ->where('ma_sp','=',$item->id)->get();
            foreach ($hoadon as $value)
            {
                $dem ++;
            }
            $num[$i]=$dem;
            $dem=0;
            $count++;
            $i++;

        }


        return view('hoadon_sell.gave_order',compact('num','sp','count'));
    }
    // tra hang/ hoan tien
    public function order_sell_moneyaway()
    {
        $user = Auth::user();
        $sp = DB::table('sanpham')
            ->join('ct_hoadon','ct_hoadon.ma_sp','=','sanpham.id')
            ->join('users','users.id','=','sanpham.ma_nguoidung')
            ->join('hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
            ->where('users.id','=',$user->id)
            ->where('hoadon.trang_thai','=','4')
            ->select('ct_hoadon.ma_sp','sanpham.ten_sp','sanpham.id')->groupBy('ct_hoadon.ma_sp')
            ->paginate(10);
        $dem=0;
        $count=0;
        $num=array();
        $i=0;
        foreach ($sp as $item)
        {
            $hoadon = DB::table('ct_hoadon')
                ->select('ma_hoadon')
                ->where('ma_sp','=',$item->id)->get();
            foreach ($hoadon as $value)
            {
                $dem ++;
            }
            $num[$i]=$dem;
            $dem=0;
            $count++;
            $i++;

        }


        return view('hoadon_sell.monney_away',compact('num','sp','count'));
    }
    //don bi huy
    public function order_sell_delete()
    {
        $user = Auth::user();
        $sp = DB::table('sanpham')
            ->join('ct_hoadon','ct_hoadon.ma_sp','=','sanpham.id')
            ->join('users','users.id','=','sanpham.ma_nguoidung')
            ->join('hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
            ->where('users.id','=',$user->id)
            ->where('hoadon.is_delete','=','1')
            ->select('ct_hoadon.ma_sp','sanpham.ten_sp','sanpham.id')
            ->groupBy('ct_hoadon.ma_sp')
            ->paginate(10);
        $dem=0;
        $count=0;
        $num=array();
        $i=0;
        foreach ($sp as $item)
        {
            $hoadon = DB::table('ct_hoadon')
                ->select('ma_hoadon')
                ->where('ma_sp','=',$item->id)->get();
            foreach ($hoadon as $value)
            {
                $dem ++;
            }
            $num[$i]=$dem;
            $dem=0;
            $count++;
            $i++;

        }


        return view('hoadon_sell.delete_oder',compact('num','sp','count'));
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
