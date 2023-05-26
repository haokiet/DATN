<?php

namespace App\Http\Controllers;

use App\Models\Nguoidung;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use http\Env\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NguoidungController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
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
        return view('nguoidung.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create($request->all());


    }

    /**
     * Display the specified resource.
     */
    public function show(Nguoidung $nguoidung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nguoidung $nguoidung)
    {
        //
    }
    public function up_shop()
    {
        $user=Auth::user();
        return view('nguoiban.profile_shop',compact('user'));
    }
    public function updateUser(Request $request)
    {

        if($request->file('anh_nd') != null){


            $uploadedFileUrl = cloudinary()->upload($request->file('anh_nd')->getRealPath())->getSecurePath();


        }
        else{
            $uploadedFileUrl=null;
        }

        $user = Auth::user();
        $profile = User::find($user->id);
        $profile->username = $request->username;
        $profile->so_dt_nd = $request->so_dt_nd;
        $profile->gioi_tinh = $request->gioi_tinh;
        $profile->ngay_sinh = $request->ngay_sinh;
        $profile->image = $uploadedFileUrl;
        $profile->dia_chi = $request->dia_chi;
        $profile->save();
        return back();
    }
    public function update_shop(Request $request)
    {
        $user=Auth::user();
        $shop = User::find($user->id);
        $shop->username=$request->username;
        $shop->image=$request->image;
        $shop->dia_chi=$request->dia_chi;
        $shop->so_dt=$request->so_dt;
        //$shop->mo_ta=$request->mo_ta;

        $shop->save();
        return redirect('/sell/up_shop');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nguoidung $nguoidung)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nguoidung $nguoidung)
    {
        //
    }
    public function register( Request $request)
    {


        $user  = User::all();

        foreach ($user as $item)
        {
            if ($request->email == $item->email && $item->is_delete == 0)
            {
                $check  =0;
                break;
            }
            elseif ($request->email == $item->email && $item->is_delete == 1)
            {
                $check = 1;
                break;
            }
            else{
                $check = 2;
            }
        }
        if($check == 2)
        {
            $token = strtoupper(Str::random(10));

            $data=$request->only('username','email','password','token');
            if($request->password === $request->Re_password){
                $password_h= bcrypt($request->password);
                $data['password'] = $password_h;
                $data['token']=$token;
                if ($user=User::create($data)){
                    Mail::send('emails.active_account',compact('user'),function($email) use ($user) {
                        $email->subject('xac nhan tai khoan');
                        $email->to($user->email,$user->username);
                    });
                    return back()->with('thongbao','đã đăng ký. Bạn hãy kiểm tra gmail của bạn để xác nhận tài khoản');
                }
            }
            else{
                return back()->with('thongbao','mật khẩu nhập lại không khớp');
            }
        }
        elseif ($check == 0)
        {
            return back()->with('thongbao','tài khoản đã đăng ký trước đó và chờ xác nhận');
        }
        else{
            return back()->with('thongbao','tài khoản đã tồn tại');
        }
    }
    public function active (User $user, $token){
        if ($user->token === $token ){
            $user->update(['is_delete'=>1,'token'=>null]);
            return redirect()->route('home')->with('yes','xac nhan tai khoan thanh cong');
        } else{
            return redirect()->route('home')->with('yes','xacs nhan khong hop le');
        }
    }

    public function showUser($id)
    {
        $user = Auth::user();
        $us = User::find($id);
        $i=0;

        $sp=DB::table('sanpham')
            ->where('trang_thai','=',1)
            ->where('so_luong','>',0)
            ->where('ma_nguoidung','=',$id)
            ->get();

$sp2 = null;
$giaban=array();
$giaban[0]=0;
       if (count($sp) >0)
       {
           foreach ($sp as $item)
           {
               $u = DB::table('users')
                   ->join('sanpham','sanpham.ma_nguoidung','=','users.id')
                   ->where('users.id','=',$id)
                   ->where('trang_thai','=',1)
                   ->where('so_luong','>',0)
                   ->get();
               $sp2= $u;
           }

           if ($sp2 !==null)
           {
               foreach ($sp2 as $item)
               {
                   $giaban[$i] = $item->gia_goc - $item->khuyen_mai;
                   $i++;
               }
           }
       }

//            $gia_goc = DB::table('sanpham')->value('gia_goc');
//            $khuyen_mai = DB::table('sanpham')->value('khuyen_mai');

//            dd($giaban);


        return view('nguoidung.show',compact('sp2','giaban','us'));
    }

    public function login()
    {

        return view('nguoidung.index');
    }
    public function check_login(Request $request)
    {

        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password,'is_delete'=>1],$request->remember)) {

            $user = Auth::user();
            if ($user->role ===1)
            {
                return redirect('/shipper');
            }
            else if ($user->role===2)
            {
                return redirect('/admin');
            }
           else
           {
               return redirect()->intended();
           }
        }
        else{
            return redirect('/login')->with('thongbao','tên đăng nhập hoặc mật khẩu không đúng');
        }

    }
    public function sell_regis (){
        return
            \view('nguoiban.index',);
    }

    public function chanePass()
    {

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
