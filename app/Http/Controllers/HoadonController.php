<?php

namespace App\Http\Controllers;

use App\Models\CT_Hoadon;
use App\Models\Hoadon;
use App\Models\Sanpham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\PDF;


class HoadonController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    //tất cả hóa đơn phía người bán
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
    // chờ xác nhận
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
                ->where('ct_hoadon.ma_sp','=',$item->id)
                ->get();

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

        return view('hoadon_sell.giving_order',compact('num','sp','count'));
    }
    // đã giao
    public function order_sell_gave()
    {
        $user = Auth::user();
        $sp = DB::table('sanpham')
            ->join('ct_hoadon','ct_hoadon.ma_sp','=','sanpham.id')
            ->join('users','users.id','=','sanpham.ma_nguoidung')
            ->join('hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
            ->where('users.id','=',$user->id)
            ->where('hoadon.trang_thai','=','4')
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
                ->where('hoadon.trang_thai','=',4)
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
            ->where('hoadon.trang_thai','=','5')
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
                ->where('hoadon.trang_thai','=',5)
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
            ->where('hoadon.is_delete','=',1)
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
//show hóa đơn
    public function showall($id)
    {
        $user = Auth::user();

        $hd = DB::table('hoadon')
            ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
            ->join('users','users.id','=','sanpham.ma_nguoidung')
            ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
            ->where('users.id','=',$user->id)
            ->where('ct_hoadon.ma_sp','=',$id)
            ->get();
        $check = 1;
        return view('hoadon_sell.order_detail_wait',compact('user','hd','check'));
    }
//chi tiết hóa đơn bán
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
            ->where('ct_hoadon.ma_sp','=',$id)
            ->get();
        $check = 0;
        return view('hoadon_sell.order_detail_wait',compact('user','hd','check'));
    }
    // sell-wait detail
    public function sellShowWait($id)
    {
        $user = Auth::user();

        $hd = DB::table('hoadon')
            ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
            ->join('users','users.id','=','sanpham.ma_nguoidung')
            ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
            ->where('users.id','=',$user->id)
            ->where('hoadon.trang_thai','=',1)
            ->where('ct_hoadon.ma_sp','=',$id)
            ->get();
        $check = 0;
        return view('hoadon_sell.sell_order_detail_wait',compact('user','hd','check'));
    }
    //chi tiết hóa đơn
    public function showGiving($id)
    {
        $user = Auth::user();

        $hd = DB::table('hoadon')
            ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
            ->join('users','users.id','=','sanpham.ma_nguoidung')
            ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
            ->where('users.id','=',$user->id)
            ->where('hoadon.trang_thai','=',3)
            ->where('ct_hoadon.ma_sp','=',$id)->get();
        $check = 0;
        return view('hoadon_sell.order_detail_wait',compact('user','hd','check'));
    }
//chi tiết hóa đơn
    public function showGave($id)
    {
        $user = Auth::user();

        $hd = DB::table('hoadon')
            ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
            ->join('users','users.id','=','sanpham.ma_nguoidung')
            ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
            ->where('users.id','=',$user->id)
            ->where('hoadon.trang_thai','=',4)
            ->where('ct_hoadon.ma_sp','=',$id)
            ->get();
        $check = 0;
        return view('hoadon_sell.order_detail_wait',compact('user','hd','check'));
    }
//chi tiết hóa đơn
    public function showAway($id)
    {
        $user = Auth::user();

        $hd = DB::table('hoadon')
            ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
            ->join('users','users.id','=','sanpham.ma_nguoidung')
            ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
            ->where('users.id','=',$user->id)
            ->where('hoadon.trang_thai','=',5)
            ->where('ct_hoadon.ma_sp','=',$id)
            ->get();
        $check  =0;
        return view('hoadon_sell.order_detail_wait',compact('user','hd','check'));
    }

    // show xác nhận hóa đơn người dùng
    public function buyshowWait()
    {
        $user = Auth::user();

        $hd = DB::table('hoadon')
            ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
            ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
            ->where('hoadon.ma_nguoidung','=',$user->id)
            ->where('hoadon.is_delete','=',0)
            ->where('hoadon.trang_thai','=',1)
            ->get();
        $hh = array();

        $i=0;
        $hd2 = DB::table('hoadon')
            ->where('hoadon.ma_nguoidung','=',$user->id)
            ->where('hoadon.trang_thai','=',1)
            ->where('hoadon.is_delete','=',0)
            ->get();

        foreach ($hd2 as $item)
        {
            $hh[$i] = DB::table('vanchuyen')
                ->join('hoadon','hoadon.ma_vanchuyen','=','vanchuyen.id')
                ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                ->join('users','sanpham.ma_nguoidung','=','users.id')
                ->join('thanhtoan','thanhtoan.ma_hoadon','=','hoadon.id')
                ->where('hoadon.ma_nguoidung','=',$user->id)
                ->where('hoadon.is_delete','=',0)
                ->where('hoadon.id','=',$item->id)
                ->where('hoadon.trang_thai','=',1)
                ->select([
                    'ten_vc',
                    'don_gia_vc',
                    'ma_vanchuyen',
                    'dia_chi_nhan',
                    'ten_nhan',
                    'so_dt_nhan',
                    'thanhtoan.ma_hoadon',
                    'sanpham.ma_nguoidung',
                    'hoadon.trang_thai',
                    'so_luong_mua',
                    'anh_sp',
                    'ten_sp',
                    'so_luong',
                    'gia_goc',
                    'khuyen_mai',
                    'ma_sp',
                    'username',
                    'thanhtoan.trang_thai as thanhtoan'

                ])
                ->get();
            $i++;
        }

        $m = 0; $n = 1; $k =0; $s=array(); $s[0]=0; $tong=array();
        $vc =0;
        foreach ($hh as $t)
        {
            foreach ($t as $v)
            {
                $s[$n] = $s[$m] + (($v->gia_goc - $v->khuyen_mai)*$v->so_luong_mua);
                $vc = $v->don_gia_vc;
                $m++; $n++;
            }
            $tong[$k]=$s[$n-1] + $vc;
            $k++;
            $m = 0; $n = 1; $s[0]=0;
        }


        // show hóa đơn đã xác nhận

        $hh2 = array();

        $j=0;
        $hd3 = DB::table('hoadon')
            ->where('hoadon.ma_nguoidung','=',$user->id)
            ->where('hoadon.trang_thai','>',1)
            ->get();
        foreach ($hd3 as $item)
        {
            $hh2[$j] = DB::table('vanchuyen')
                ->join('hoadon','hoadon.ma_vanchuyen','=','vanchuyen.id')
                ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                ->join('users','sanpham.ma_nguoidung','=','users.id')
                ->where('hoadon.ma_nguoidung','=',$user->id)
                ->where('hoadon.id','=',$item->id)
                ->where('hoadon.trang_thai','>',1)
                ->select([
                    'ten_vc',
                    'don_gia_vc',
                    'ma_vanchuyen',
                    'dia_chi_nhan',
                    'ten_nhan',
                    'so_dt_nhan',
                    'ma_hoadon',
                    'sanpham.ma_nguoidung',
                    'hoadon.trang_thai',
                    'so_luong_mua',
                    'anh_sp',
                    'ten_sp',
                    'so_luong',
                    'gia_goc',
                    'khuyen_mai',
                    'ma_sp',
                    'username',
                    'hoadon.is_delete'

                ])
                ->get();
            $j++;
        }
        $m1 = 0; $n1 = 1; $k1 =0; $s1=array(); $s1[0]=0; $tong1=array();
        $vc1 = 0;
        foreach ($hh2 as $t)
        {
            foreach ($t as $v)
            {
                $s1[$n1] = $s1[$m1] + (($v->gia_goc - $v->khuyen_mai)*$v->so_luong_mua);
                $vc1 = $v->don_gia_vc;
                $m1++; $n1++;
            }
            $tong1[$k1]=$s1[$n1-1] + $vc1;
            $k1++;
            $m1 = 0; $n1 = 1; $s1[0]=0;
        }


        if(isset($_GET['message']))
        {
            if($_GET['message']!=="Successful.")
            {
                $hd0 = DB::table('hoadon')->where('ma_nguoidung','=',$user->id)
                    ->where('trang_thai','=',0)->get();
                $orderid = explode("+", $_GET['orderInfo']);
                $cou = count($orderid);
                for ($dem =0; $dem< $cou - 1;$dem++)
                {
                    $h7 = DB::table('hoadon')
                        ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                        ->where('hoadon.id','=',$orderid[$dem])
                        ->get();
                   foreach ($h7 as $_h7)
                   {
                       CT_Hoadon::create([
                           'ma_hoadon'=>$hd0[0]->id,
                           'ma_sp'=>$_h7->ma_sp,
                           'so_luong_mua'=>$_h7->so_luong_mua
                       ]);
                   }
                }
                for ($dem =0; $dem< $cou - 1;$dem++)
                {
                    $order = Hoadon::find($orderid[$dem]);
                    $order->delete();
                }
            }
        }
        return view('nguoimua.order',compact('user','hd','hd2','hh','tong','tong1','hh2'));
    }
    //xác nhận hóa đơn bên mua
    public  function confimWait($id)
    {
        $user = Auth::user();
        $hd = DB::table('hoadon')->where('id','=',$id)->update([
            'trang_thai'=>2,
        ]);

        $cthd = DB::table('ct_hoadon')
            ->join('hoadon','hoadon.id','ct_hoadon.ma_hoadon')
            ->where('hoadon.id','=',$id)
            ->where('hoadon.trang_thai','=',2)
            ->get();

        foreach ($cthd as $value)
        {
            $sp = DB::table('sanpham')->where('sanpham.id','=',$value->ma_sp)->get();
            foreach ($sp as $item)
            {
                DB::table('sanpham')->where('sanpham.id','=',$value->ma_sp)
                    ->update([
                        'so_luong'=>$item->so_luong - $value->so_luong_mua
                    ]);
            }

        }

        return back();
    }
    // hủy xác nhận
    public  function deleteWait($id)
    {
        $sp=Hoadon::find($id);
        $sp->is_delete=1;
        $sp->save();

        return back()->with('thongbao','Đã hủy hóa đơn');
    }

    /**
     * Show.
     */

    //hiển thị hóa đơn cần giao
    function Giaohang(){
        $user = Auth::user();
        $hd = null; $i=0;
        $ct_hd = DB::table('hoadon')
            ->join('ct_hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
            ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
            ->join('thanhtoan','hoadon.id','=','thanhtoan.ma_hoadon')
            ->where('hoadon.trang_thai','=',1)
            ->where('sanpham.ma_nguoidung','=',$user->id)
            ->select([
                'ten_vc',
                'don_gia_vc',
                'ma_vanchuyen',
                'dia_chi_nhan',
                'ten_nhan',
                'so_dt_nhan',
                'thanhtoan.ma_hoadon',
                'sanpham.ma_nguoidung',
                'hoadon.trang_thai',
                'so_luong_mua',
                'anh_sp',
                'ten_sp',
                'so_luong',
                'gia_goc',
                'khuyen_mai',
                'ma_sp',
                'thanhtoan.trang_thai as thanhtoan'

            ])
            ->get();
        $cound = count($ct_hd);
        $hd2 = null;
       if ($cound >0)
       {
           foreach ($ct_hd as $item)
           {
               $hd[$i] = $item->ma_hoadon;
               $i++;
           }
           $hd2 = array_unique($hd);
       }
        return view('hoadon_sell.giaohang',compact('user','hd2','ct_hd'));
    }

    function detailGiaohang( $id)
    {
        $idhd = $id;
        $user = Auth::user();
        $ct_hd = DB::table('ct_hoadon')
            ->join('hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
            ->join('vanchuyen','vanchuyen.id','=','hoadon.ma_vanchuyen')
            ->where('hoadon.id','=',$id)
            ->get();

        return view('hoadon_sell.detail_giaohang',compact('idhd','user','ct_hd'));
    }
    //xác nhận giao hàng
    function confimGiaohang( $id)
    {
       $hd= Hoadon::find($id);
        $hd->trang_thai = 2;
        $hd->save();

//        $user = Auth::user();
//        $ct_hd = DB::table('ct_hoadon')
//            ->join('hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
//            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
//            ->join('vanchuyen','vanchuyen.id','=','hoadon.ma_vanchuyen')
//            ->where('hoadon.id','=',$id)
//            ->get();
//        $data = [
//            'title' => 'Chào mừng bạn đến với Shop Rập may',
//            'date' => date('m/d/Y'),
//           'ct_hd'=>$ct_hd
//        ];
//
//        $pdf = PDF::loadView('myPDF', $data);
//
//        $pdf->download('itsolutionstuff.pdf');

        return redirect('/sell/giaohang')->with('thongbao','Đã chuyển hàng');
    }

    public function tongLoinhuan()
    {
        $user = Auth::user();
//        $hoadon = DB::table('hoadon')
//            ->join('ct_hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
//            ->join('vanchuyen','vanchuyen.id','=','hoadon.ma_vanchuyen')
//            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
//            ->where('sanpham.ma_nguoidung','=',$user->id)
//            ->get();
//        $i=0; $v=null;$k=null;
//        foreach ($hoadon as $_hoadon)
//        {
//            $v[$i] = $_hoadon->ma_hoadon;
//            $i++;
//        }
//        $k = array_unique($v);
        $hd1 = DB::table('sanpham')
            ->join('ct_hoadon','ct_hoadon.ma_sp','=','sanpham.id')
            ->join('users','users.id','=','sanpham.ma_nguoidung')
            ->join('hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
            ->join('vanchuyen','hoadon.ma_vanchuyen','=','vanchuyen.id')
            ->where('users.id','=',$user->id)
            ->where('hoadon.trang_thai','=','4')
            ->get();
        $tong = 0; $i=0;$v=null;
        foreach ($hd1 as $item)
        {
            $v[$i] =$item->ma_hoadon;
            $tong = $tong + ($item->gia_goc)*$item->so_luong_mua;
            $i++;
        }
        $k = array_unique($v);
        $j=0;
        foreach ($k as $_k)
        {
            $hoadon[$j] = DB::table('hoadon')
                ->join('ct_hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
                ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                ->where('hoadon.id','=',$_k)
                ->get();
            $j++;
        }
        $tong_cuoi = 0;
        foreach ($hoadon as $_hoadon)
        {
            foreach ($_hoadon as $_hd)
            {
                $tong_cuoi = $tong_cuoi + $_hd->gia_goc * $_hd->so_luong_mua;
            }
        }

        $cc = $tong - $tong_cuoi;

        return view('hoadon_sell.loinhuan',compact('user','cc'));
    }

}
