@include('layout.header')


    <div class="cart body-home">
        <div class="cart-item">
            <input type="checkbox" class="check-all">
        </div>
        <div class="cart-item">
            san pham
        </div>
        <div class="cart-item">
            don gia
        </div>
        <div class="cart-item">
            so luong
        </div>
        <div class="cart-item">
            so tien
        </div>
        <div class="cart-item">
            thao tac
        </div>

    </div>
<?php $i=0; $tong=0?>

<form action="{{route('thanhtoan-index')}}" method="post">
    @csrf
@foreach($ct_hd as $value)

    <div class="cart body-home">
        <div class="cart-item">
            <input type="checkbox" class="checkbox" name="checkbox[]" onclick="checbox()"
                   value="{{$value->id}}">
        </div>
        <div class="cart-item">
            @if($value->anh_sp !==null)
            <img class="cart-img" src="{{$value->anh_sp}}">
            @else
            <img class="cart-img" src="{{asset('images/user.png')}}">
            @endif
            {{$value->ten_sp}}
        </div>
        <div class="cart-item">
            {{$value->gia_goc - $value->khuyen_mai}}
        </div>
        <div class="cart-item">
            {{$value->so_luong_mua}}
        </div>
        <div class="cart-item">
            <input class="tien-item tong_so" name="tien-item[]" type="text" readonly value="{{$tien = $value->so_luong_mua * ($value->gia_goc - $value->khuyen_mai)}}"> vnd
        </div>
        <div class="cart-item">
            <a href="{{route('delete-giohang',$value->ma_sp)}}">xóa</a>
        </div>
        <?php $tong = $tong + $tien;?>

    </div>
@endforeach

    <div id="divtongtien" class="bottom-cart">
        <div id="x" class="bottom-thanhtoan">
           <div  class="div-tong"> vận chuyển: <select name="vc">
                   @foreach($vanchuyen as $item)
                       <option value="{{$item->id}}">{{$item->ten_vc}} - {{$item->don_gia_vc}}</option>
                   @endforeach
               </select>
                Tổng tiền: <input id="tong-tien" name="tong_tien" readonly> vnd
                <button class="button-cart" type="submit" name="submit" >mua hàng</button>
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
