@include('layout.header_shipper')
<div class="body-home">
    <div class="margin-top">
        @if (session('ketqua'))
            <div class="session-status">
                {{ session('ketqua') }}
            </div>
        @endif
        <table class="sell_table">
            <tr>

                <td>thông tin hóa đơn</td>
                <td>thông tin người nhận</td>
                <td>số lượng</td>
                <td>đơn giá</td>
                <td></td>

            </tr>
        </table>
        <table class="sell_table">
            <?php $i=0;?>

            @if($hh !==null)
                @foreach($hh as $value)

                    @foreach($value as $item)

                        <tr>
                            <td>
                                @if($item->anh_sp !==null)
                                    <img class="cart-img" src="{{$item->anh_sp}}"></img>
                                @else
                                    <img class="cart-img" src="{{asset('images/user.png')}}">
                                @endif
                            </td>
                            <td>
                                <p>tên: {{$item->ten_nhan}}</p>
                                <p>số dt: {{$item->so_dt_nhan}}</p>
                                <p>địa chỉ: {{$item->dia_chi_nhan}}</p>
                            </td>
                            <td>
                                {{$item->so_luong_mua}}
                            </td>
                            <td>
                                {{($item->gia_goc - $item->khuyen_mai)*$item->so_luong_mua + $item->don_gia_vc}}
                            </td>
                            @endforeach
                            @if($item !== 0)
                                <td>
                                    <button class="button-cart" type="submit" name="submit" ><a href="{{route('shipper-confim-order',$value[0]->ma_hoadon)}}">nhận đơn</a></button>
                                </td>
                        </tr>

                        @endif
                            <?php $i++; ?>
                    @endforeach
            @endif
        </table>
    </div>
    {{--    <div class="page">{{ $sp->links()}}</div>--}}

</div>

