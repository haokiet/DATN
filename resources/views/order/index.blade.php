@include('layout.header')


    <div class="cart body-home">
        <div class="cart-item">
            <input type="checkbox" class="check-all">
        </div>
        <div class="cart-item">
            Sản phẩm
        </div>
        <div class="cart-item">
            Đơn giá
        </div>
        <div class="cart-item">
            Số lượng
        </div>
        <div class="cart-item">
            Số tiền
        </div>
        <div class="cart-item">
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
            {{$value->gia_goc - $value->khuyen_mai}}
        </div>
        <div class="cart-item text-giua">
            {{$value->so_luong_mua}}
        </div>
        <div class="cart-item text-giua">
            <input class="tien-item tong_so" name="tien-item[]" type="text" readonly value="{{$tien = $value->so_luong_mua * ($value->gia_goc - $value->khuyen_mai)}}">vnd
        </div>
        <div class="cart-item text-giua">
            <a href="{{route('delete-giohang',$value->ma_sp)}}">xóa</a>
        </div>
        <?php $tong = $tong + $tien;?>

    </div>
@endforeach

    <div id="divtongtien" class="bottom-cart">
        <div id="x" class="bottom-thanhtoan">
           <div  class="div-tong2">
               <div></div>
               <div> Tổng tiền: <input id="tong-tien" name="tong_tien" readonly> vnd</div>
                <div><button class="button-cart" type="submit" name="submit" >mua hàng</button></div>
            </div>

        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-latest.js"></script>
    <script>

            var checkbox = document.getElementsByName('checkbox[]');
            var tien = document.getElementsByName('tien-item[]');
            var divtong = document.getElementById("div-tongtien");

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
                document.getElementById("tong-tien").value =resuilt;

            }
            // In ra kết quả




    </script>
