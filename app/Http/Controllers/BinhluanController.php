<?php

namespace App\Http\Controllers;

use App\Models\Binhluan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BinhluanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        dd($request->all());
        $user = Auth::user();
        Binhluan::create([
            'ma_nguoidung'=>$user->id,
            'ma_sp'=>$request->id_sp,
            'danh_gia'=>$request->star,
            'noi_dung'=>$request->nd_bl
        ]);
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
}
