<?php

namespace App\Http\Controllers;

use App\Models\CT_Hoadon;
use App\Models\Hoadon;
use App\Models\Phuongthuc;
use App\Models\Sanpham;
use App\Models\Thanhtoan;
use App\Models\User;
use App\Models\Vanchuyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use function GuzzleHttp\Promise\all;

class ThanhtoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function view(Request $request)
    {

       if ($request->tong_tien !==null)
       {
           $nd = array();
           $h = 0;
           foreach ($request->checkbox as $checkbox)
           {
               $nd[$h]  = DB::table('users')
                   ->join('sanpham','sanpham.ma_nguoidung','=','users.id')
                   ->where('sanpham.id','=',$checkbox)
                   ->get();
               $h ++;
           }
           $y  =0;
           foreach ($nd as $u)
           {
               $t[$y] = $u[0]->email;
               $y++;
           }
           $v = array_unique($t);
           $user = Auth::user();
           $ct_hdd = array();
           $i = 0;

           if ($request->id_sp !==null)
           {
               $hdd2 = DB::table('hoadon')
                   ->where('ma_nguoidung','=',$user->id)
                   ->where('trang_thai','=','0')
                   ->get();

               $dem=count($hdd2);

               if ($dem ===0)
               {
                   Hoadon::create([
                       'ma_nguoidung'=>$user->id,
                       'dia_chi_nhan'=>$user->dia_chi,
                       'ten_nhan'=>$user->username,
                       'so_dt_nhan'=>$user->so_dt,
                       'ma_van_chuyen'=>1
                   ]);
               }

               $hdd = DB::table('hoadon')
                   ->where('ma_nguoidung','=',$user->id)
                   ->where('trang_thai','=','0')
                   ->get();

               $k = $request->id_sp + 0;
               $ct = DB::table('ct_hoadon')
                   ->where('ma_hoadon','=',$hdd[0]->id)
                   ->where('ma_sp','=',$k)->get();
               if(!isset($ct[0]))
               {
                   CT_Hoadon::create([
                       'ma_hoadon'=>$hdd[0]->id,
                       'ma_sp'=>$k,
                       'so_luong_mua'=>$request->so_luong
                   ]);
               }

               $ct_hdd[$i] = DB::table('ct_hoadon')
                   ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                   ->join('users','users.id','=','sanpham.ma_nguoidung')
                   ->join('hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
                   ->where('ct_hoadon.ma_sp','=',$k)
                   ->where('ct_hoadon.ma_hoadon','=',$hdd[0]->id)
                   ->where('hoadon.trang_thai','=',0)
                   ->get();


           }
           else
           {
               $hd = DB::table('hoadon')
                   ->where('ma_nguoidung','=',$user->id)
                   ->where('trang_thai','=',0)
                   ->get();

               foreach ($request->checkbox as $item)
               {
                   $ct_hdd[$i] = DB::table('ct_hoadon')
                       ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
                       ->join('users','users.id','=','sanpham.ma_nguoidung')
                       ->join('hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
                       ->where('ct_hoadon.ma_sp','=',$item)
                       ->where('ct_hoadon.ma_hoadon','=',$hd[0]->id)
                       ->where('hoadon.trang_thai','=',0)
                       ->get();
                   $i++;
               }
           }
           $tong = 0;
           $vanchuyen = Vanchuyen::all();
           $phuongthuc = Phuongthuc::all();
//        foreach ($ct_hdd as $value)
//        {
//            $tong = $tong + (($value->gia_goc - $value->khuyen_mai)*$value->so_luong_mua);
//        }
//        $tong_all = $tong + $vanchuyen->don_gia_vc;
           return view('thanhtoan.index',compact('ct_hdd','vanchuyen','phuongthuc','user','v'));
       }
       else
       {
           return back()->with('thongbao','Bạn hãy chọn sản phẩm cần mua');
       }
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

   public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function sauKhiNhanHang(Request $request)
    {

        $user =Auth::user();

        if ($request->pt ==1)
        {
            foreach ($request->email as $_email)
            {
                $tong = 0;
                $hd = Hoadon::create([
                    'ma_nguoidung'=>$user->id,
                    'ma_vanchuyen'=>$request->idvc,
                    'dia_chi_nhan'=>$request->dia_chi_nhan,
                    'ten_nhan'=>$request->ten_nhan,
                    'trang_thai'=>1,
                    'so_dt_nhan'=>$request->so_dt_nhan
                ]);
                foreach ($request->idsp as $_idsp) {
                    $ct_hd = DB::table('ct_hoadon')
                        ->where('ma_hoadon','=',$request->idhd)
                        ->where('ma_sp','=',$_idsp)
                        ->get();
                    $sp = Sanpham::find($_idsp);
                    $seller = User::find($sp->ma_nguoidung);
                    if ($_email == $seller->email)
                    {
                        CT_Hoadon::create([
                            'ma_hoadon'=>$hd->id,
                            'ma_sp'=>$_idsp,
                            'so_luong_mua'=>$ct_hd[0]->so_luong_mua
                        ]);
                        $db = DB::table('ct_hoadon')
                            ->join('hoadon','ct_hoadon.ma_hoadon','=','hoadon.id')
                            ->where('hoadon.id','=',$request->idhd)
                            ->where('ct_hoadon.ma_sp','=',$_idsp)
                            ->delete();

                        $tong = $tong + (($sp->gia_goc - $sp->khuyen_mai) * $ct_hd[0]->so_luong_mua );
                    }
                }
                Thanhtoan::create([
                    'ma_hoadon'=>$hd->id,
                    'ma_phuongthuc'=>$request->pt,
                    'tong_tien'=>$tong + $request->gtvc
                ]);
            }


            return redirect('/order/deatil_wait_buy');

        }

        else
        {

            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = $request->tong_tien;
            $orderId = time() ."";
            $redirectUrl = "http://127.0.0.1:8000/order/deatil_wait_buy";
            $ipnUrl = "http://127.0.0.1:8000/order/deatil_wait_buy";
            $extraData = "";


                $requestId = time() . "";
                $requestType = "payWithATM";
//                $requestType = "captureMoMoWallet";
//                $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                //before sign HMAC SHA256 signature
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $secretKey);
                $data = array('partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature);
                $result = $this->execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);

                return redirect()->to($jsonResult['payUrl']);
//                header('Location: ' . $jsonResult['payUrl']);
        }
    }


    public function momo(Request $request){

    }
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Thanhtoan $thanhtoan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thanhtoan $thanhtoan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thanhtoan $thanhtoan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thanhtoan $thanhtoan)
    {
        //
    }
}
