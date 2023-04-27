<?php

namespace App\Http\Controllers;

use App\Models\C_T_Theloai;
use App\Models\Photos;
use App\Models\Sanpham;
use App\Models\Theloai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //đang bán
    public function index()
    {
        $user = Auth::user();
        $sp_all = DB::table('sanpham')
            ->where('trang_thai','=','1')
            ->where('so_luong','>','0')
            ->where('ma_nguoidung','=',$user->id)
            ->orderByDesc('created_at')
            ->simplePaginate(6);
        $sp_all2 = DB::table('sanpham')
            ->where('trang_thai','=','1')
            ->where('so_luong','>','0')
            ->where('ma_nguoidung','=',$user->id)
            ->orderByDesc('created_at')
            ->get();
        return view('sanpham.sell_index',compact('sp_all','sp_all2'));
    }
    //chưa duyệt
    public function index2()
    {
        $user = Auth::user();

        $sp_zero = DB::table('sanpham')
            ->where('trang_thai','=','0')
            ->where('ma_nguoidung','=',$user->id)
            ->orderByDesc('created_at')
            ->simplePaginate(6);
        $sp_zero2 = DB::table('sanpham')
            ->where('trang_thai','=','0')
            ->where('ma_nguoidung','=',$user->id)
            ->orderByDesc('created_at')
            ->get();
        return view('sanpham.sell_notduyet',compact('sp_zero','sp_zero2'));
    }
    //hết hàng
    public function index3()
    {
        $user = Auth::user();

        $sp_no = DB::table('sanpham')
            ->where('so_luong','=','0')
            ->where('ma_nguoidung','=',$user->id)
            ->orderByDesc('created_at')
            ->simplePaginate(6);
        $sp_no2 = DB::table('sanpham')
            ->where('so_luong','=','0')
            ->where('ma_nguoidung','=',$user->id)
            ->orderByDesc('created_at')
            ->get();
        return view('sanpham.sell_hethang',compact('sp_no','sp_no2'));
    }
    //vi phạm
    public function index4()
    {
        $user = Auth::user();

        $sp_dele = DB::table('sanpham')
            ->where('is_delete','=','1')
            ->where('ma_nguoidung','=',$user->id)
            ->orderByDesc('created_at')
            ->simplePaginate(6);
        $sp_dele2 = DB::table('sanpham')
            ->where('is_delete','=','1')
            ->where('ma_nguoidung','=',$user->id)
            ->orderByDesc('created_at')
            ->get();
        return view('sanpham.sell_delete',compact('sp_dele','sp_dele2'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $theloai = Theloai::all();
        return view('sanpham.themsp',compact('theloai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $idND = Auth::id();

        if($request->file('anh_sp') != null){

            $urlImage = 'image'.time().'.'.$request->anh_sp->extension();
            $request->anh_sp->move(public_path('images'), $urlImage);
        }
        else{
            $urlImage='null.png';
        }

        $sp = Sanpham::create([
            'ten_sp' => $request->input('ten_sp'),
            'anh_sp' => $urlImage,
            'mo_ta' => $request->input('mo_ta'),
            'ma_nguoidung' => $idND,
            'so_luong'=>$request->input('so_luong'),
            'gia_goc'=>$request->input('gia_goc'),
        ]);

        $photo=$request->file('url');
        if ($photo)
        {
            foreach($photo as $value){
                $urlmm = 'image'.time().'.'.$value->extension();
                $value->move(public_path('images'),$urlmm);
                Photos::create([
                    'ma_sp' => $sp->id,
                    'url' => $urlmm
                ]);
            }
        }

        $theloais = $request->input('theloai');

            C_T_Theloai::create([
                'ma_sp' => $sp->id,
                'ma_theloai' => $theloais
            ]);

        return redirect('/sell/all-sp');
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

        $anh=DB::table('photos')->join('sanpham','sanpham.id','=','photos.ma_sp','inner')
            ->where('sanpham.id','=',$id)
        ->select('url')->get();

        $bl=DB::table('binhluan')->join('sanpham','sanpham.id','=','binhluan.ma_sp')
            ->join('users','users.id','=','binhluan.ma_nguoidung')
            ->where('sanpham.id','=',$id)
            ->select('*')->get();

        $giaban=$sp->gia_goc - $sp->khuyen_mai;

        $sp2=DB::table('sanpham')
            ->join('ct_theloai','sanpham.id','=','ct_theloai.ma_sp')
        ->where('sanpham.trang_thai','=',1)->get() ;

        return view('sanpham.show',compact('sp','c_t_theloai','anh','bl','sp2','giaban'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sp = DB::table('sanpham')->find($id);
        return view('sanpham.sell_edit_sp',compact('sp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sp=Sanpham::find($id);
        dd($sp);
        $sp->ten_sp=$request->ten_sp;
        $sp->mo_ta=$request->mo_ta;
        $sp->so_luong=$request->so_luong;
        $sp->gia_goc=$request->gia_goc;
        $sp->khuyen_mai=$request->khuyen_mai;
        $sp->ngay_km=$request->ngay_km;
        $sp->ket_thuc_km=$request->ket_thuc_km;
        $sp->save();
        return redirect('/sell/all-sp');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $sp=Sanpham::find($id);
        $sp->delete();
        return redirect('/sell/all-sp');
    }
}
