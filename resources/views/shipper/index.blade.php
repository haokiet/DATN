@include('layout.header_shipper')
<div class="body-home">
    <div class="body-home">
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
            @foreach($hh as $value)

                        @foreach($value as $item)

                            <tr>
                                <td>
                                    <img class="cart-img"  src="{{asset('images/'.$item->anh_sp)}}">
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
                                    <button class="button-cart" type="submit" name="submit" ><a href="{{route('confim-wait',$value[0]->ma_hoadon)}}">nhận đơn</a></button>
                                </td>
                            </tr>
                        <?php $i++; ?>
                    @endif

            @endforeach
        </table>
    </div>
    {{--    <div class="page">{{ $sp->links()}}</div>--}}

</div>
