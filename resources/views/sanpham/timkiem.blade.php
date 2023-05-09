<div>
    @include('layout.header')

    <div >
        <div class="body-home">
            <h2 class="kttk">Kết quả tìm kiếm</h2>
            <div class="tk_1 body-home">
                <h3>Sản phẩm</h3>
                <div>
                    @if($sp3 !==null)
                            <?php $i=0;  ?>

                        @foreach ($sp3 as $item )
                            @foreach ($item as $value)

                        <div class="td-sp2">
                            <div>
                                @if($value->anh_sp !==null)
                                    <iframe  class="anh_sp" src="{{$value->anh_sp}}"></iframe>
                                @else
                                    <img class="anh_sp" src="{{asset('images/user.png')}}">
                                @endif
                            </div>

                            <div class="home_a">
                                <a href="{{route('sanpham.show',$value->id)}}"><?php echo $value->ten_sp;?></a>
                            </div>
                            <div>
                                <p>giá bán: <?php echo $giaban[$i]." "."đ"; endforeach;?></p>
                            </div>

                        </div>
                            <?php $i++; endforeach;?>
                        @else
                        <h5 class="center">không tìm thấy kết quả</h5>
                    @endif
                </div>
            </div>

            <div>
                <h3>Nhà thiết kế</h3>
                <div class="tk_1 body-home">
                @if($users2 !==null)
                        @foreach ($users2 as $item )
                        @foreach ($item as $value)

                    <div class="td-sp2">
                        <div>
                            @if($value->anh_sp !==null)
                                <img  class="anh_sp" src="{{$value->anh_sp}}">
                            @else
                                <img class="anh_sp" src="{{asset('images/user.png')}}">
                            @endif
                        </div>

                        <div class="home_a">
                            <a href="{{route('sanpham.show',$value->id)}}"><?php echo $value->username;?></a>
                        </div>
                    </div>

                            @endforeach
                            @endforeach
                    @else
                        <h5 class="center">không tìm thấy kết quả</h5>
                @endif

                </div>
            </div>
        </div>
    </div>
    <div>
        <h2 class="body-home">tất cả sản phẩm</h2>
        @include('sanpham.index')
    </div>
</div>