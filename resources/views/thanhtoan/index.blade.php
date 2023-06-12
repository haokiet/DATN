@include('layout.header')

<div class="body-home">
   <div class="content-thanhtoan">
       <div>
           <div class="div-thanhtoan">
               <div>
                   <h2>Thông tin sản phẩm</h2>
               </div>
               <div>
                   <h2>đơn giá</h2>
               </div>
               <div>
                   <h2>số lượng</h2>
               </div>
               <div>
                   <h2>thành tiền</h2>
               </div>

           </div>
           <?php $idhd = 0; $tong = 0; $tong2=0; ?>
           <form action="{{route('thanhtoan-sknh')}}" method="post">
               @csrf
               @foreach($v as $_v)
                   <input hidden name="email[]" value="{{$_v}}">
                   <?php $tong_ct=0; ?>
               <div class=" boder bottom-tt">

                       <div class="div-thanhtoan">
                                   @foreach($ct_hdd as $item)
                               @if($item[0]->email == $_v)

                                       <div>
                                           <input type="hidden" name="idsp[]" value="{{$item[0]->ma_sp}}">
                                               <?php $idhd =$item[0]->ma_hoadon;?>
                                           <div class="img-l">
                                               @if($item[0]->anh_sp !==null)
                                                   <img class="cart-img" src="{{$item[0]->anh_sp}}">
                                               @else
                                                   <img class="cart-img" src="{{asset('images/user.png')}}">
                                               @endif
                                           </div>
                                           <p>{{$item[0]->ten_sp}}</p>
                                       </div>
                                       <div>

                                           <p>
                                               {{
                                                 number_format(($item[0]->gia_goc - $item[0]->khuyen_mai), 0, '', ',')
                                               }}
                                               <span> VNĐ</span>
                                           </p>
                                       </div>
                                       <div>
                                           <input class="tong_so margin-sl" name="slm[]" value="{{$item[0]->so_luong_mua}}">
                                       </div>
                                       <div>

                                           <p>
                                               {{
                                                 number_format(($item[0]->gia_goc - $item[0]->khuyen_mai)*$item[0]->so_luong_mua, 0, '', ',')
                                               }}
                                               <span> VNĐ</span>
                                           </p>
                                       </div>
                                       <?php $tong = $tong + ($item[0]->gia_goc - $item[0]->khuyen_mai)*$item[0]->so_luong_mua; $tong_ct = $tong_ct + ($item[0]->gia_goc - $item[0]->khuyen_mai)*$item[0]->so_luong_mua; ?>

                                 @endif

                       @endforeach
                           <?php $i = 0;?>
                       </div>
                   <div class="display_flex">
                       <div class="width-50">

                       </div>
                       <div class=" width-50">
                           <p class="float-right">Tổng: <input class="tong_ct" id="tong_ct" name="tong_ct" type="text" readonly value="{{number_format($tong_ct, 0, '', ',')}} vnd"></p>
                       </div>
                   </div>
               </div>
               @endforeach

       </div>

       <div class="right-thanhtoan">
           <h2>Thông tin nhận hàng</h2>
           <table class="table-thanhtoan">
               <tr>
                   <td>nơi nhận hàng:</td>
                   <td><input class="input-diachi" required name="dia_chi_nhan" value="{{$user->dia_chi}}"></td>
               </tr>
               <tr>
                   <td>người nhận:</td>
                   <td><input class="input-diachi" required name="ten_nhan" value="{{$user->username}}"></td>
               </tr>
               <tr>
                   <td>số điện thoại:</td>
                   <td><input class="input-diachi" required name="so_dt_nhan" value="{{$user->so_dt_nd}}"></td>
               </tr>
               <tr>
                   <td colspan="2"><h4>phương thức thanh toán</h4></td>
               </tr>
               <tr>
                   <td colspan="2"> @foreach($phuongthuc as $t)
                           <input required type="radio" name="pt" checked value="{{$t->id}}">{{$t->ten_pt}}
                   @endforeach
               </tr>
               <tr>
                   <td colspan="2"> <div>vận chuyển: <select id="vc" name="vc">
                               @foreach($vanchuyen as $item)
                                   <option value="{{$item->id}}">{{$item->ten_vc}} + {{$item->don_gia_vc}}</option>
                               @endforeach
                           </select></div></td>
               </tr>
           </table>
           <input type="hidden" name="idhd" value="{{$idhd}}">
           <input  name="idvc" hidden id="idvc" value="">
           <input  name="gtvc" hidden id="gtvc" value="">
           <input  name="tong" hidden id="tong" value="{{$tong}}">
       </div>
   </div>

</div>
<div id="divtongtien" class="bottom-cart">

    <div id="x" class="bottom-thanhtoan">
        <div  class="display_flex float-right">
            <div>
                Tổng số hóa đơn:<input class="border-none input-tt" id="so_hd" value="">
            </div>
           <div> Tổng tiền: <input class="input-tt tong_ct" id="tong-tien" name="tong_tien" value="{{$tong}} " readonly> vnd</div>
            <div>
                <button class="button-cart corso" type="submit" name="payUrl" >đặt hàng</button>
{{--                <button class="button-cart" type="submit" name="submit" >đặt hàng</button>--}}
            </div>

{{--            <button class="button-cart" type="submit" name="submit" >đặt hàng</button>--}}
        </div>

    </div>
</div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        let e = document.getElementById('vc');
        let tt = document.getElementsByName('tong_ct');
        let gt = e.options[e.selectedIndex].text;
        const regex = /\d/g; // tìm các kí tự số
        const mang  = gt.match(regex)
        const gtvc =  parseInt(mang.join(""))
       document.getElementById('idvc').value = document.getElementById('vc').value

        document.getElementById('gtvc').value = gtvc ;
       document.getElementById('tong-tien').value = parseInt(document.getElementById('tong').value) + (gtvc * tt.length) ;
       document.getElementById('so_hd').value=tt.length


        $("#vc").change(function(){
            let gt = e.options[e.selectedIndex].text;
                document.getElementById('idvc').value = document.getElementById('vc').value;
            const mang  = gt.match(regex)
            const gtvc =  parseInt(mang.join(""))
            document.getElementById('gtvc').value = gtvc ;

            document.getElementById('tong-tien').value =  parseInt(document.getElementById('tong').value) + (gtvc *tt.length) ;
        });

    });
</script>
