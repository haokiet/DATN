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
           <?php $idhd = 0; $tong = 0; $tong2=0 ?>
{{--           <form action="{{route('thanhtoan-sknh')}}" method="post">--}}
           <form action="{{route('thanhtoan-sknh')}}" method="post">
               @csrf
           @foreach($ct_hdd as $item)
               @foreach($item as $value)

                   <div class="div-thanhtoan">
                       <div>
                           <input type="hidden" name="idsp[]" value="{{$value->ma_sp}}">
                           <?php $idhd =$value->ma_hoadon;?>
                          <div class="img-l">
                              @if($value->anh_sp !==null)
                                  <img class="cart-img" src="{{$value->anh_sp}}">
                              @else
                                  <img class="cart-img" src="{{asset('images/user.png')}}">
                              @endif
                          </div>
                           <p>{{$value->ten_sp}}</p>
{{--                           vận chuyển: {{$vanchuyen->ten_vc}} - {{$vanchuyen->don_gia_vc}}--}}
                       </div>
                       <div>
                           {{$value->gia_goc - $value->khuyen_mai}}
                       </div>
                       <div>
                           <input class="tong_so" name="slm[]" value="{{$value->so_luong_mua}}">
                       </div>
                       <div>
                           {{($value->gia_goc - $value->khuyen_mai)*$value->so_luong_mua}} vnd
                       </div>
                   </div>
                   <?php $tong = $tong + ($value->gia_goc - $value->khuyen_mai)*$value->so_luong_mua; ?>
               @endforeach

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
        <div  class="div-tong">
           <div> Tổng tiền: <input id="tong-tien" name="tong_tien" value="{{$tong}}" readonly> vnd</div>
            <div>
                <button class="button-cart" type="submit" name="payUrl" >đặt hàng</button>
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
        let gt = e.options[e.selectedIndex].text;
        const regex = /\d/g; // tìm các kí tự số
        const mang  = gt.match(regex)
        const gtvc =  parseInt(mang.join(""))
        document.getElementById('idvc').value = document.getElementById('vc').value
        document.getElementById('gtvc').value = gtvc ;
       document.getElementById('tong-tien').value = parseInt(document.getElementById('tong').value) + gtvc ;



        $("#vc").click(function(){
            let gt = e.options[e.selectedIndex].text;
                document.getElementById('idvc').value = document.getElementById('vc').value;
            const mang  = gt.match(regex)
            const gtvc =  parseInt(mang.join(""))
            document.getElementById('gtvc').value = gtvc ;
            document.getElementById('tong-tien').value = parseInt(document.getElementById('tong').value) + gtvc ;
        });

    });
</script>
