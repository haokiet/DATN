@include('layout.header')


    <div class="cart body-home margin-top">
        <div class="cart-item ">
            <input type="checkbox" class="check-all">
        </div>
        <div class="cart-item text-giua">
            Sản phẩm
        </div>
        <div class="cart-item text-giua">
            Đơn giá
        </div>
        <div class="cart-item text-giua">
            Số lượng
        </div>
        <div class="cart-item text-giua">
            Số tiền
        </div>
        <div class="cart-item text-giua">
            Thao tác
        </div>

    </div>
<?php $i=0; $tong=0?>

<form action="{{route('thanhtoan-index')}}" method="post">
    @csrf
@foreach($ct_hd as $value)

    <div class="cart body-home bor">
        <div class="cart-item">
            <input type="checkbox" class="checkbox" name="checkbox[]" onclick="checbox()"
                   value="{{$value->id}}">
        </div>
        <div class="cart-item chia_cot_table">
            <div>
                @if($value->anh_sp !==null)
                    <img class="cart-img" src="{{$value->anh_sp}}">
                @else
                    <img class="cart-img" src="{{asset('images/user.png')}}">
                @endif
            </div>
           <div>
               <a href="{{route('sanpham.show',$value->id)}}">{{$value->ten_sp}}</a>
           </div>
        </div>
        <div class="cart-item text-giua">

            <p>
                {{
                  number_format($value->gia_goc - $value->khuyen_mai, 0, '', ',')
                }}
                <span> VNĐ</span>
            </p>
        </div>
        <div class="cart-item text-giua">
            {{$value->so_luong_mua}}
        </div>
        <div class="cart-item text-giua">
            <input name="tien-item[]" hidden value="{{$tien = $value->so_luong_mua * ($value->gia_goc - $value->khuyen_mai)}}">
            <input class="tien-item tong_so"  type="text" readonly value="{{number_format($value->so_luong_mua * ($value->gia_goc - $value->khuyen_mai), 0, '', ',')}} ">vnd
        </div>
        <div class="cart-item text-giua">
            <a href="{{route('delete-giohang',$value->ma_sp)}}">xóa</a>
        </div>
        <?php $tong = $tong + $tien;?>

    </div>
@endforeach

    <div id="divtongtien" class="bottom-cart">
        <div id="x" class="bottom-thanhtoan">
           <div  class="div-tong2 ">
               <div class="session-status">
                   @if(session('thongbao'))
                       {{session('thongbao')}}
                       @endif
               </div>
               <div> Tổng tiền: <input id="tong-tien" name="tong_tien" readonly></div>
                <div><button class="button-cart corso" type="submit" name="submit" >mua hàng</button></div>
            </div>

        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-latest.js"></script>
    <script>

            var checkbox = document.getElementsByName('checkbox[]');
            var tien = document.getElementsByName('tien-item[]');
            var divtong = document.getElementById("div-tongtien");
            var formatter = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            });

                $(function (){

                    if(parseInt(checkbox.length) ==0)
                    {
                        $("#divtongtien").hide();
                    }
                    else
                    {
                        $("#divtongtien").show();
                    }
                })



            async function checbox(){

                let resuilt=0;
                for(var i = 0; i<checkbox.length; i++)
                {
                    if(checkbox[i].checked ===true){
                        resuilt = resuilt + parseInt( tien[i].value);
                    }
                }
                document.getElementById("tong-tien").value =  formatter.format(resuilt);

            }
            // In ra kết quả




    </script>
