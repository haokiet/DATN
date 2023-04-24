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
               $hd = DB::table('hoadon')
                   ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                   ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                   ->join('users','users.id','=','sanpham.ma_nguoidung')
                   ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
                   ->where('users.id','=',$user->id)
                   ->where('ct_hoadon.ma_sp','=',$item->id)->get();

               $num[$i]=count($hd);
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
            $hd = DB::table('hoadon')
                ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                ->join('users','users.id','=','sanpham.ma_nguoidung')
                ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
                ->where('users.id','=',$user->id)
                ->where('hoadon.trang_thai','=',1)
                ->where('ct_hoadon.ma_sp','=',$item->id)->get();

            $num[$i]=count($hd);
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
            $hd = DB::table('hoadon')
                ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                ->join('users','users.id','=','sanpham.ma_nguoidung')
                ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
                ->where('users.id','=',$user->id)
                ->where('hoadon.trang_thai','=',2)
                ->where('ct_hoadon.ma_sp','=',$item->id)->get();

            $num[$i]=count($hd);
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


            $hd = DB::table('hoadon')
                ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                ->join('users','users.id','=','sanpham.ma_nguoidung')
                ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
                ->where('users.id','=',$user->id)
                ->where('hoadon.trang_thai','=',3)
                ->where('ct_hoadon.ma_sp','=',$item->id)->get();

            $num[$i]=count($hd);
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
            $hd = DB::table('hoadon')
                ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                ->join('users','users.id','=','sanpham.ma_nguoidung')
                ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
                ->where('users.id','=',$user->id)
                ->where('hoadon.trang_thai','=',4)
                ->where('ct_hoadon.ma_sp','=',$item->id)->get();

            $num[$i]=count($hd);
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
            $hd = DB::table('hoadon')
                ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                ->join('users','users.id','=','sanpham.ma_nguoidung')
                ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
                ->where('users.id','=',$user->id)
                ->where('hoadon.is_delete','=',1)
                ->where('ct_hoadon.ma_sp','=',$item->id)->get();

            $num[$i]=count($hd);
            $count++;
            $i++;

        }


        return view('hoadon_sell.delete_oder',compact('num','sp','count'));
    }
    public function showWait($id)
    {
        $user = Auth::user();

        $hd = DB::table('hoadon')
            ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
            ->join('users','users.id','=','sanpham.ma_nguoidung')
            ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
            ->where('users.id','=',$user->id)
            ->where('hoadon.trang_thai','=',1)
            ->where('ct_hoadon.ma_sp','=',$id)->get();
        return view('hoadon_sell.order_detail_wait',compact('user','hd'));
    }
    public function showGiving($id)
    {
        $user = Auth::user();

        $hd = DB::table('hoadon')
            ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
            ->join('users','users.id','=','sanpham.ma_nguoidung')
            ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
            ->where('users.id','=',$user->id)
            ->where('hoadon.trang_thai','=',2)
            ->where('ct_hoadon.ma_sp','=',$id)->get();
        return view('hoadon_sell.order_detail_wait',compact('user','hd'));
    }
    public function buyshowWait()
    {
        $user = Auth::user();

        $hd = DB::table('hoadon')
            ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
            ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
            ->where('hoadon.ma_nguoidung','=',$user->id)
            ->where('hoadon.trang_thai','=',1)
            ->get();
        $hh = array();
        $i=0;
        $hd2 = DB::table('hoadon')
            ->where('hoadon.ma_nguoidung','=',$user->id)
            ->where('hoadon.trang_thai','=',1)
            ->get();

        foreach ($hd2 as $item)
        {
            $hh[$i] = DB::table('hoadon')
                ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
                ->where('hoadon.ma_nguoidung','=',$user->id)
                ->where('hoadon.id','=',$item->id)
                ->where('hoadon.trang_thai','=',1)
                ->get();
            $i++;
        }
        return view('nguoimua.order',compact('user','hd','hd2','hh'));
    }
    public  function confimWait($id)
    {
        $user = Auth::user();
        $hd = DB::table('hoadon')->where('id','=',$id)->update([
            'trang_thai'=>2
        ]);

        return redirect('/');
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
