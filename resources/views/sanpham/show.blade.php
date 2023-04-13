@include('layout.header')

<link rel="stylesheet" href="../../css/app.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<div class="show_sp">

    <div class="show_sp_left">

        <div class="khung_sp" >
            <img class="ct_anh" src="{{asset('images/'.$sp->anh_sp)}}">
            <div class="khung_sp" >
                <?php  $giaban=$sp->gia_goc - $sp->khuyen_mai;?>

                @foreach ($anh as $item)
                <img class="ct_photos" src="{{asset('images/'.$item->url)}}">
                @endforeach

            </div>

        </div>

    </div>
    <div class="show_sp_right">
        <div class="right-show">

            <table align="center">
                <tr>
                    <td colspan="3"><h2>

                            {{$sp->ten_sp}}
                        </h2></td>
                </tr>
                <tr>
                    <th>
                        thời trang:
                    </th>
                    <td>

                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        @foreach ($c_t_theloai as $item)
                            {{$item->tenloai}},
                        @endforeach
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        đánh giá:
                    </td>
                    <td>

                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        giá:
                    </td>
                    <td>
                        <p class="gia_show">{{$sp->gia_goc}} đ</p> -
                        <p class="gia_show"> {{$sp->khuyen_mai}} đ</p>
                    </td>
                    <td>

                        <p class="giaban_show">{{$giaban}} đ</p>
                    </td>
                </tr>
                <tr>
                    <td>số lượng</td>
                </tr>

            </table>
            <div >
                <button class="show_sp_giohang"><a class="show_sp_giohang" href="#">Thêm vào giỏ hàng</a><i class="fa fa-shopping-cart icon-cart"></i></button>
            </div>



        </div>
    </div>

</div>
<div class="div-2">
    <div class="show_left2">
        <div class="show_mota">
            <h2>Mô tả sản phẩm</h2>
            {{$sp->mo_ta}}

        </div>
        <div class="show_binhluan">
            <h2>Đánh giá</h2>
            <?php foreach ($bl as $item):?>

            <div>
                <img src="{{asset('images/'.$item->image)}}">
                <p class="ten_bl">{{$item->ho}}</p>
                <p class="ten_bl">{{$item->ten}}</p>
            </div>
            đánh giá: {{$item->danh_gia}}
            <div>
                {{$item->noi_dung}}
            </div>
            <?php endforeach;?>


        </div>
    </div>
    <div class="show_right2">
        <div class="sp_cungloai">
            <h2 class="h2-cungloai">sản phẩm cùng thời trang</h2>
{{--            <?php  for ($i=0;$i<count($sp2);$i++){--}}
{{--                for ($j=$i+1;$j<count($sp2)-1;$j++){--}}
{{--                    if (($sp2[$i]->id !== $sp2[$j]->id) & ($sp2[$i]->id !== $sp->id) & ($sp2[$i]->ma_theloai === $c_t_theloai[$i]->id)){--}}

{{--                        ?>--}}
{{--                        <div class="td-sp cungloai">--}}
{{--                            <?php $giaban = $sp2[$i]->gia_goc - $sp2[$i]->khuyen_mai; ?>--}}
{{--                            <img class="anh_sp" src="{{asset('images/'.$sp2[$i]->anh_sp)}}">--}}

{{--                            <br>--}}
{{--                            <a href="{{route('show',$sp2[$i]->id)}}"><?php echo $sp2[$i]->ten_sp;?></a>--}}

{{--                            <br>--}}
{{--                            <p>giá bán: <?php echo $giaban ; ?> đ</p>--}}

{{--                        </div>--}}


{{--                     <?php }}}  ?>--}}


            <?php foreach ($sp2 as $item ) : foreach ($c_t_theloai as $k): ?>
                <?php if(($item->id !==$sp->id) & ($item->ma_theloai === $k->id)){?>
            <div class="td-sp cungloai">
                    <?php $giaban = $item->gia_goc - $item->khuyen_mai;?>
                <img class="anh_sp" src="{{asset('images/'.$item->anh_sp)}}">
                <br>
                <a href="{{route('sanpham.show',$item->id)}}"><?php echo $item->ten_sp;?></a>
                <br>
                <p>giá bán: <?php echo $giaban ; ?> đ</p>
            </div>
            <?php }?>
            <?php endforeach; endforeach;?>



        </div>
    </div>
</div>
