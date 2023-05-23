<?php

namespace App\Http\Controllers;

use App\Models\C_T_Theloai;
use App\Models\Photos;
use App\Models\Sanpham;
use App\Models\Theloai;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use JD\Cloudder\Facades\Cloudder;

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
            ->where('trang_thai','>','0')
            ->where('so_luong','>','0')
            ->where('ma_nguoidung','=',$user->id)
            ->orderByDesc('created_at')
            ->simplePaginate(6);
        $sp_all2 = DB::table('sanpham')
            ->where('trang_thai','>','0')
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

//            $data =\Illuminate\Support\Facades\File::get($request->file('anh_sp'));
//           Storage::disk('google')
//            ->put($urlImage,$data,'public');
//            Cloudder::upload($urlImage, 'DATN/' . $request->anh_sp);

            $uploadedFileUrl = cloudinary()->upload($request->file('anh_sp')->getRealPath())->getSecurePath();


        }
        else{
            $uploadedFileUrl=null;
        }
        $sp = Sanpham::create([
            'ten_sp' => $request->input('ten_sp'),
            'anh_sp' => $uploadedFileUrl,
            'mo_ta' => $request->input('mo_ta'),
            'ma_nguoidung' => $idND,
            'so_luong'=>$request->input('so_luong'),
            'gia_goc'=>$request->input('gia_goc'),
        ]);

            if ($request->file('url') !==null)
            {
                foreach($request->file('url') as $value){
                    $uploadedFileUrl2 = cloudinary()->upload($value->getRealPath())->getSecurePath();
                    Photos::create([
                        'ma_sp' => $sp->id,
                        'url' => $uploadedFileUrl2
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
       // $user = Auth::user();
       // $isVa = password_verify('123456', $user->password);
        $sp=DB::table('theloai')
            ->join('sanpham','sanpham.ma_theloai','=','theloai.id')
            ->where('sanpham.id','=',$id)
            ->get();
        $nguoidung = User::find($sp[0]->ma_nguoidung);


        $anh=DB::table('photos')->join('sanpham','sanpham.id','=','photos.ma_sp','inner')
            ->where('sanpham.id','=',$id)
        ->select('url')->get();

        $bl=DB::table('sanpham')
            ->join('binhluan','sanpham.id','=','binhluan.ma_sp')
            ->join('users','users.id','=','binhluan.ma_nguoidung')
            ->where('sanpham.id','=',$id)
            ->where('binhluan.is_delete','=',0)
            ->select(['*','binhluan.updated_at'])->get();

        $giaban=$sp[0]->gia_goc - $sp[0]->khuyen_mai;

        $sp2=DB::table('theloai')
            ->join('sanpham','sanpham.ma_theloai','=','theloai.id')
        ->where('sanpham.trang_thai','=',1)->get() ;


        $dg = DB::table('binhluan')->where('ma_sp','=',$id)->get();
        $tb = count($dg);
        $d_g=0;
        if ($tb !==0)
        {
            foreach ($dg as $item)
            {
                $d_g =$d_g + $item->danh_gia;
            }
            $kq = round($d_g/$tb,1);
        }
        else{
            $kq = 0;
        }

        return view('sanpham.show',compact('sp','anh','bl','sp2','giaban','kq','nguoidung'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sp = DB::table('sanpham')->find($id);
        $theloai = Theloai::all();
        return view('sanpham.sell_edit_sp',compact('sp','theloai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sp=Sanpham::find($id);
        if ($request->file('anh_sp') !==null)
        {
            $uploadedFileUrl = cloudinary()->upload($request->file('anh_sp')->getRealPath())->getSecurePath();
            $sp->anh_sp = $uploadedFileUrl;

        }
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

    public function timKiem(Request $request)
    {

        $i = 0;
        $sp1=DB::table('sanpham')
            ->where('trang_thai','=',1)
            ->where('so_luong','>',0)
            ->where('ten_sp','like',$request->value."%")
            ->orWhere('ten_sp','like',"%".$request->value)
            ->orWhere('ten_sp','like',"%".$request->value."%")
            ->get();

        $sp3 =null;
        $users2 = null;
        $v=0;
        foreach ($sp1 as $item)
        {
            $sp3[$v] = DB::table('users')
                ->join('sanpham','users.id','=','sanpham.ma_nguoidung')
                ->where('users.is_delete','=',1)
                ->where('users.id','=',$item->ma_nguoidung)
                ->where('sanpham.id','=',$item->id)
                ->get();
            $v++;
        }
        $user = DB::table('users')
            ->where('username','like',$request->value."%")
            ->orWhere('username','like',"%".$request->value)
            ->orWhere('username','like',"%".$request->value."%")
            ->get();
        $v = 0;
        foreach ($user as $u)
        {
            $users2[$v] = DB::table('users')
                ->where('is_delete','=',1)
                ->where('users.id','=',$u->id)
                ->get();
            $v++;
        }

        if($sp3 !==null)
        {
            foreach ($sp3 as $item)
            {
                foreach ($item as $value)
                $giaban[$i] = $value->gia_goc - $value->khuyen_mai;
                $i++;
            }
        }

        $giaban=array();
        $i=0;
        $sp=DB::table('sanpham')
            ->where('trang_thai','=',1)
            ->where('so_luong','>',0)
            ->get();
        $j = 0;
        $sp2 ="";


        foreach ($sp as $item)
        {
            $u = DB::table('users')
                ->join('sanpham','sanpham.ma_nguoidung','=','users.id')
                ->where('users.is_delete','=',1)
                ->where('trang_thai','=',1)
                ->where('so_luong','>',0)
                ->get();
            $sp2= $u;
        }
        foreach ($sp2 as $item)
        {
            $giaban[$i] = $item->gia_goc - $item->khuyen_mai;
            $i++;
        }
     return view('sanpham.timkiem',compact('sp3','sp2','users2','giaban'));
    }
}

