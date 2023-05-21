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
           <?php $idhd = 0; $tong = 0 ?>
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
                           vận chuyển: {{$vanchuyen->ten_vc}} - {{$vanchuyen->don_gia_vc}}
                       </div>
                       <div>
                           {{$value->gia_goc - $value->khuyen_mai}}
                       </div>
                       <div>
                           <input class="tong_so" name="slm[]" value="{{$value->so_luong_mua}}">
                       </div>
                       <div>
                           {{($value->gia_goc - $value->khuyen_mai)*$value->so_luong_mua + $vanchuyen->don_gia_vc}} vnd
                       </div>
                   </div>
                   <?php $tong = $tong + ($value->gia_goc - $value->khuyen_mai)*$value->so_luong_mua + $vanchuyen->don_gia_vc; ?>
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
                           <input required type="radio" name="pt" value="{{$t->id}}">{{$t->ten_pt}}
                   @endforeach
               </tr>
           </table>
           <input type="hidden" name="idhd" value="{{$idhd}}">
           <input type="hidden" name="idvc" value="{{$vanchuyen->id}}">
       </div>
   </div>

</div>
<div id="divtongtien" class="bottom-cart">
    <div id="x" class="bottom-thanhtoan">
        <div  class="div-tong"> Tổng tiền: <input id="tong-tien" name="tong_tien" value="{{$tong}}" readonly> vnd
            <button class="button-cart" type="submit" name="submit" >đặt hàng</button>
{{--            <button class="button-cart" type="submit" name="submit" >đặt hàng</button>--}}
        </div>

    </div>
</div>
</form>
<script src="https://code.jquery.com/jquery-latest.js"></script>
<script>

</script>
