<?php

namespace App\Http\Controllers;

use App\Models\Sanpham;
use App\Models\Theloai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $giaban=array();
        $i=0;
        $sp=Sanpham::all()->where('trang_thai','=',1);
        foreach ($sp as $item)
        {

            $giaban[$i] = $item->gia_goc - $item->khuyen_mai;
            $i++;
        }
//            $gia_goc = DB::table('sanpham')->value('gia_goc');
//            $khuyen_mai = DB::table('sanpham')->value('khuyen_mai');

//            dd($giaban);



        return view('sanpham.home',compact('sp','giaban'));

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
    public function show($id)
    {
        $sp=DB::table('sanpham')->find($id);

        $c_t_theloai = DB::table('ct_theloai')
            ->join('theloai','theloai.id','=','ct_theloai.ma_theloai','inner')
            ->join('sanpham','sanpham.id','=','ct_theloai.ma_sp','inner')
        ->where('sanpham.id','=',$id)->select(['theloai.tenloai','theloai.id'])->get();
//dd($c_t_theloai);
        $anh=DB::table('photos')->join('sanpham','sanpham.id','=','photos.ma_sp','inner')
            ->where('sanpham.id','=',$id)
        ->select('url')->get();

        $bl=DB::table('binhluan')->join('sanpham','sanpham.id','=','binhluan.ma_sp')
            ->join('nguoidung','nguoidung.id','=','binhluan.ma_nguoidung')
            ->where('sanpham.id','=',$id)
            ->select('*')->get();

        $giaban=$sp->gia_goc - $sp->khuyen_mai;
        //dd($c_t_theloai);
        $sp2=DB::table('sanpham')
            ->join('ct_theloai','sanpham.id','=','ct_theloai.ma_sp')
        ->where('sanpham.trang_thai','=',1)->get();
        //dd($sp2);
        return view('sanpham.show',compact('sp','c_t_theloai','anh','bl','sp2','giaban'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sanpham $sanpham)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sanpham $sanpham)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sanpham $sanpham)
    {
        //
    }
}
