<?php

namespace App\Http\Controllers;

use App\Models\Sanpham;
use App\Models\Theloai;
use App\Models\User;
use App\Models\Vanchuyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function SP(){
        $sp=DB::table('sanpham')
            ->where('trang_thai','=','1')
            ->orderByDesc('created_at')
            ->get();
        return view('admin.all_sp',compact('sp'));
    }
    public function allSP(){
        $sp=DB::table('sanpham')
            ->where('trang_thai','=','0')
            ->orderByDesc('created_at')
            ->get();
        return view('admin.all_sp',compact('sp'));
    }
    public function duyetSP($id){
        $sp=DB::table('theloai')
            ->join('sanpham','sanpham.ma_theloai','=','theloai.id')
            ->where('sanpham.id','=',$id)
            ->get();

        $nguoidung = User::find($sp[0]->ma_nguoidung);


        $anh=DB::table('photos')->join('sanpham','sanpham.id','=','photos.ma_sp','inner')
            ->where('sanpham.id','=',$id)
            ->select('url')->get();

        $giaban=$sp[0]->gia_goc - $sp[0]->khuyen_mai;

        return view('admin.duyet_sp',compact('sp','nguoidung','anh','giaban'));
    }
    public function confimDuyet($id){
        $sp=Sanpham::find($id);
        $sp->trang_thai=1;
        $sp->save();
        return redirect('/admin');
    }


    public function vipham($id)
    {
        $sp =Sanpham::find($id);
        $sp->is_delete = 1;
        $sp->save();
        return view('admin.all_sp')->with('thongbao','báo cáo thành công');
    }


    // người dùng

    public function all_user()
    {
        $users = DB::table('users')->where('is_delete','=',1)->get();
        return view('admin.all_users',compact('users'));

    }
    public function chiTiet($id)
    {
        $us = User::find($id);
        $sp = DB::table('sanpham')
            ->where('sanpham.ma_nguoidung','=',$id)
            ->where('trang_thai','=',1)
            ->get();
        $dem  = count($sp);
        return view('admin.show_user ',compact('us','dem'));
    }

    public function updateUser(Request $request, $id)
    {

        $user = User::find($id);
        $user->role = $request->role;
        $user->save();
        return back()->with('thongbao','Đã cập nhật quyền người dùng');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->is_delete = 0;
        $user->save();
        return back()->with('thongbao','Đã hủy hoạt động người dùng');
    }

    public function createUser()
    {
        $theloai  = Theloai::all();
        return view('admin.create_user',compact('theloai'));
    }
    public function storeUser(Request $request){

        $data=$request->only('username','email','password','dia_chi','gioi_tinh','ngay_sinh','role','so_dt_nd');
        if($request->password === $request->repassword){
            if($request->file('anh_nd') != null){


                $uploadedFileUrl = cloudinary()->upload($request->file('anh_nd')->getRealPath())->getSecurePath();


            }
            else{
                $uploadedFileUrl=null;
            }
            $password_h= bcrypt($request->password);

            User::create([
                'username'=>$request->username,
                'email'=>$request->email,
                'password'=>$password_h,
                'dia_chi'=>$request->dia_chi,
                'gioi_tinh'=>$request->gioi_tinh,
                'ngay_sinh'=>$request->ngay_sinh,
                'role'=>$request->role,
                'so_dt_nd'=>$request->so_dt_nd,
                'image'=>$uploadedFileUrl
            ]);

            return back()->with('thongbao','Đã thêm thành công');
        }
        else{
            return back()->with('thongbao','mật khẩu nhập lại không khớp');
        }
    }

    public function adminVanchuyen(){
        $vc = Vanchuyen::all();
        return view('admin.all_vanchuyen',compact('vc'));
    }

    public function themVC(Request $request){
        Vanchuyen::create([
            'ten_vc'=>$request->ten_vc,
            'don_gia_vc'=>$request->don_gia_vc
        ]);
        return back()->with('thongbao','đã thêm vận chuyển');
    }

    public function xoaVC($id){
        $vc = Vanchuyen::find($id);
        $vc->delete();
        return back()->with('thongbao','đã xóa vận chuyển');
    }
    public function updateVC(Request $request,$id){
        DB::table('vanchuyen')->where('id','=',$id)
            ->update([
                'ten_vc'=>$request->ten_vc,
                'don_gia_vc'=>$request->don_gia_vc
            ]);
        return back()->with('thongbao','đã cập nhật vận chuyển');
    }
}
