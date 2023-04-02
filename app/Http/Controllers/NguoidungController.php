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
                return redirect()->route('home');
            }
        }
        else{
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function active (User $user, $token){
        if ($user->token === $token ){
            $user->update(['is_delete'=>1]);
            return redirect()->route('home')->with('yes','xac nhan tai khoan thanh cong');
        } else{
            return redirect()->route('home')->with('no','xacs nhan khong hop le');
        }
    }
    public function login()
    {

        return view('nguoidung.index');
    }
    public function check_login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('home');
        }
        else{
            return \view('nguoidung.index');
        }

    }
    public function sell_regis (){

       if (Auth::check())
       {


               return
                   \view('nguoiban.index',);

       }
       else{
           return \view('nguoidung.create');
       }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
