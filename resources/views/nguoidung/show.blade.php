@include('layout.header')
<div class="show_sp">
    <div class="show-lr body-home">

        <div class="khung_sp" >
            @if($us->image !==null)
                <img class="ct_anh" src="{{$us->image}}">
            @else
                <img class="ct_anh" src="{{asset('images/user.png')}}">
            @endif

        </div>

            <div>
                <h2>Shop: {{$us->username}}</h2>
                <div>
                    <h3>Địa chỉ: {{$us->dia_chi}}</h3>
                </div>
                <div><h3>Số điện thoại: {{$us->so_dt_nd}}</h3></div>
            </div>
    </div>
    <div class="body-home" align="center">
        <h2>Sản phẩm của Shop</h2>
        <?php $i=0;   foreach ($sp2 as $item ) :{  ?>
        <a href="{{route('sanpham.show',$item->id)}}">
            <div class="td-sp">
                <div>
                    @if($item !==null)
                        <img class="anh_sp" src="{{$item->anh_sp}}">
                    @else
                        <img class="anh_sp" src="{{asset('images/user.png')}}">
                    @endif
                </div>

                <div class="home_a">
                    <a href="{{route('sanpham.show',$item->id)}}"><?php echo $item->ten_sp;?></a>
                </div>
                <div  class="gb">
                    <p>giá bán: <?php echo $giaban[$i]." "."đ"; }?></p>
                </div>

            </div>
                <?php $i++; endforeach;?>
        </a>
    </div>
</div>
