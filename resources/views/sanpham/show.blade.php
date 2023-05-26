@include('layout.header')

<link rel="stylesheet" href="../../css/app.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
{{--<link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>--}}

<div class="show_sp">
    @if (session('thongbao'))
        <div class="session-status">
            {{ session('thongbao') }}
        </div>
    @endif
    <div class="show-lr">

        <div class="khung_sp" >
            @if($sp[0]->anh_sp !==null)
                <img class="ct_anh" src="{{$sp[0]->anh_sp}}">
            @else
                <img class="ct_anh" src="{{asset('images/user.png')}}">
            @endif


            <div class="khung_sp" >
                <?php  $giaban=$sp[0]->gia_goc - $sp[0]->khuyen_mai;?>

                @foreach ($anh as $item)

                     @if($item->url !==null)
                        <img class="ct_photos" src="{{$item->url}}">
                    @endif
                @endforeach

            </div>

        </div>

        <div>
            <form action="{{route('giohang',$sp[0]->id)}}" method="post">
                @csrf
            <table class="table_show" align="center">
                <tr>
                    <td colspan="3">
                        <h2>
                            {{$sp[0]->ten_sp}}
                        </h2>
                    </td>
                </tr>
                <tr>
                    <th>
                       <p> Thời trang:</p>
                    </th>
                    <td>
                       {{$sp[0]->tenloai}}
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Cửa hàng:</td>
                    <td><a href="{{route('show_user',$nguoidung->id)}}">{{$nguoidung->username}}</a></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        Đánh giá:
                    </td>
                    <td>
                       @if($kq !==0)
                            <div class="kq">
                               <p id="kq"> {{$kq}}</p>
                                <div class="stars">
                                        <?php for ($i = 0; $i< round($kq);$i++){?>
                                    <label class="star2 star-show" for="star-show"></label>

                                    <?php } ?>
                                </div>
                            </div>
                        @else
                        chưa có đánh giá
                        @endif
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        giá:
                    </td>
                    <td>
                        <p class="gia_show">{{$sp[0]->gia_goc}} đ</p> -
                        <p class="gia_show"> {{$sp[0]->khuyen_mai}} đ</p>
                    </td>
                    <td>

                        <p class="giaban_show">{{$giaban}} đ</p>
                    </td>
                </tr>

                <tr>
                    <td>số lượng</td>
                    <td>
                        <ul class="ul-show">
                            <li>
                                <input id="tru" class="btn-show" type="button" value="-">
                            </li>
                            <li>
                                <input  id="s_l" name="so_luong" type="number" required min="0" value="1">
                            </li>
                            <li>
                                <input id="cong" class="btn-show" type="button" value="+">
                            </li>
                        </ul>
                    </td>
                    <td>
                        <div class="display_flex">
                            <p>sẵn có:</p><input class="tong_so float-lefttt" value="{{$sp[0]->so_luong}}" id="tong_so" readonly><p>sản phẩm</p>
                        </div>
                    </td>
                </tr>
            </table>
                <button type="submit" class="show_sp_giohang">Thêm vào giỏ hàng <i class="fa fa-shopping-cart icon-cart"></i></button>
            </form>
           <div class="pading-am">
               <form method="post" action="{{route('thanhtoan-index')}}" >
                   @csrf
                   <input hidden id="s_l2" name="so_luong" type="number" value="1">
                   <input hidden name="id_sp" type="number" value="{{$sp[0]->id}}">
                   <button type="submit" class="show_sp_giohang">Mua ngay</button>
               </form>
           </div>
        </div>
    </div>
</div>
<div class="div-2">
    <div class="show_left2">
        <div class="show_mota">
            <h2>Mô tả sản phẩm</h2>
            {{$sp[0]->mo_ta}}

        </div>

        <div class="show_binhluan">
            <h2>Đánh giá</h2>
            <div class="nd_bl">
                <?php $ur = \Illuminate\Support\Facades\Auth::user();  ?>
               @if(\Illuminate\Support\Facades\Auth::check() && $count >0)
                    <div>
                        @if($ur->image !=null)
                            <img class="img_bl" src="{{$ur->image}}">
                        @else
                            <img class="img_bl" src="{{asset('images/user.png')}}">
                        @endif
                        <p class="ten_bl">{{$ur->username}}</p>

                    </div>

                <div class="stars">
                    <form action="{{route('danhgia')}}">
                        <input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
                        <label class="star star-5" for="star-5"></label>
                        <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                        <label class="star star-4" for="star-4"></label>
                        <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                        <label class="star star-3" for="star-3"></label>
                        <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                        <label class="star star-2" for="star-2"></label>
                        <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
                        <label class="star star-1" for="star-1"></label>
                        <textarea class="text_bl" name="nd_bl"></textarea>
                        <br>
                        <input hidden value="{{$sp[0]->id}}" name="id_sp">
                        <input type="submit" value="đánh giá">
                    </form>
                </div>
                @endif
            </div>

            <?php foreach ($bl as $item):?>

            <div class="nd_bl">
                <div>
                    @if($item->image !=null)
                        <img class="img_bl" src="{{$item->image}}">
                    @else
                        <img class="img_bl" src="{{asset('images/user.png')}}">
                    @endif
                    <p class="ten_bl">{{$item->username}}</p>
                </div>

                <div>
                    <div class="stars">
                        <?php for ($i = 0; $i< $item->danh_gia;$i++){?>
                        <label class="star2 star-show" for="star-show"></label>

                        <?php } ?>
                    </div>

                    <p>{{$item->updated_at}}</p>
                    <p class=""> {{$item->noi_dung}}</p>
                </div>
            </div>

            <?php endforeach;?>


        </div>
    </div>
    <div class="show_right2">
        <div class="sp_cungloai">
            <h2 class="h2-cungloai">sản phẩm cùng thời trang</h2>

            <?php foreach ($sp2 as $item ): ?>
            <a href="{{route('sanpham.show',$item->id)}}">
                <?php if(($item->id !==$sp[0]->id) & ($item->ma_theloai === $sp[0]->ma_theloai)){?>
            <div class="td-sp cungloai">
                    <?php $giaban = $item->gia_goc - $item->khuyen_mai;?>
                @if($item->anh_sp !==null)
                  <img class="anh_sp" src="{{$item->anh_sp}}">
                @else
                    <img class="anh_sp" src="{{asset('images/user.png')}}">
                @endif
                <br>
                <a href="{{route('sanpham.show',$item->id)}}"><?php echo $item->ten_sp;?></a>
                <br>
                <p>giá bán: <?php echo $giaban ; ?> đ</p>
            </div>
            <?php }?>

            <?php endforeach;?>


            </a>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function(){

           $("#tru").click(function(){
               if(document.getElementById('s_l').value >1)
               {
                document.getElementById('s_l').value = document.getElementById('s_l').value -1;
                   document.getElementById('s_l2').value = document.getElementById('s_l').value ;
               }
           });

        $("#cong").click(function(){
            if(parseInt(document.getElementById('s_l').value) < document.getElementById('tong_so').value  )
            {
                document.getElementById('s_l').value = parseInt(document.getElementById('s_l').value) +1;
                document.getElementById('s_l2').value = document.getElementById('s_l').value ;
            }
        });
    });
</script>
