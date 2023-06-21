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

               @if($check==1)

                   <div class=" boder bottom-tt">

                       <div class="div-thanhtoan">
                           @foreach($ct_hdd2 as $item)
                               <input hidden name="email[]" value="{{$item->email}}">
                                   <div>
                                       <input type="hidden" name="idsp[]" value="{{$item->ma_sp}}">
                                           <?php $idhd =$item->ma_hoadon;?>
                                       <div class="img-l">
                                           @if($item->anh_sp !==null)
                                               <img class="cart-img" src="{{$item->anh_sp}}">
                                           @else
                                               <img class="cart-img" src="{{asset('images/user.png')}}">
                                           @endif
                                       </div>
                                       <p>{{$item->ten_sp}}</p>
                                   </div>
                                   <div>

                                       <p>
                                           {{
                                             number_format(($item->gia_goc - $item->khuyen_mai), 0, '', ',')
                                           }}
                                           <span> VNĐ</span>
                                       </p>
                                   </div>
                                   <div>
                                       <input class="tong_so margin-sl" name="slm[]" readonly value="{{$item->so_luong_mua}}">
                                   </div>
                                   <div>
                                       <p>
                                           {{
                                             number_format(($item->gia_goc - $item->khuyen_mai)*$item->so_luong_mua, 0, '', ',')
                                           }}
                                           <span> VNĐ</span>
                                       </p>
                                   </div>
                                       <?php $tong = $tong + ($item->gia_goc - $item->khuyen_mai)*$item->so_luong_mua;  ?>

                           @endforeach
                               <?php $i = 0;?>
                       </div>
                       <div class="display_flex">
                           <div class="width-50">

                           </div>
                           <div class=" width-50">
                               <p class="float-right">Tổng: <input class="tong_ct border-none " id="tong_ct" name="tong_ct" type="text" readonly value="{{number_format($tong, 0, '', ',')}} vnd"></p>
                           </div>
                       </div>
                   </div>
                   @else
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
                                           <input class="tong_so margin-sl border-none" readonly name="slm[]" value="{{$item[0]->so_luong_mua}}">
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
                                   <p class="float-right">Tổng: <input class="tong_ct border-none" id="tong_ct" name="tong_ct" type="text" readonly value="{{number_format($tong_ct, 0, '', ',')}} vnd"></p>
                               </div>
                           </div>
                       </div>
           @endforeach
           @endif


       </div>

       <div class="right-thanhtoan text-giua">
           <h2>Thông tin nhận hàng</h2>
           <table class="table-thanhtoan">
               <tr>
                   <td>Nơi nhận hàng:</td>
                   <td><input class="input-diachi" required name="dia_chi_nhan" value="{{$user->dia_chi}}"></td>
               </tr>
               <tr>
                   <td>Người nhận:</td>
                   <td><input class="input-diachi" required name="ten_nhan" value="{{$user->username}}"></td>
               </tr>
               <tr>
                   <td>Số điện thoại:</td>
                   <td><input class="input-diachi" type="text" id="mobile" required name="so_dt_nhan" value="{{$user->so_dt_nd}}">
                       <input class="border-none session-status" readonly type="text" id="er" value="">
                   </td>
               </tr>
               <tr>
                   <td colspan="2">
                       <h4>Phương thức thanh toán</h4>
                   </td>
               </tr>
               <tr>
                   <td colspan="2">
                       @foreach($phuongthuc as $t)
                           <input required type="radio" name="pt" checked value="{{$t->id}}">{{$t->ten_pt}}
                   @endforeach
               </tr>
               <tr>
                   <td colspan="2"> <div>Vận chuyển: <select id="vc" name="vc">
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
                <button class="button-cart corso" type="submit" id="dathang" name="payUrl" >đặt hàng</button>
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

    $(document).ready(function() {
        $('body').on('mouseout','#mobile', function() {
            var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
            var mobile = $('#mobile').val();
            var checksdt = document.getElementById("mobile");
            var er = document.getElementById("er");
            if(checksdt.value !=="")
            {
                document.querySelector("#dathang").setAttribute("disabled", true);
            }
            if(mobile !==''){
                if (vnf_regex.test(mobile) == false)
                {
                    er.value = "Định dạng không đúng";
                    document.querySelector("#icon").setAttribute("disabled", true);
                }
                else
                {
                    er.value = "";
                    document.querySelector("#dathang").removeAttribute("disabled");
                }
            }else{
                er.value = "Chưa nhập số điện thoại";
            }
        });
    });
</script>
