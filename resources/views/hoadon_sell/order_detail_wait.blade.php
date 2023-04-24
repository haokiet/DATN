@extends('layout.header_order')
@section('sell-order-wait')
    <div>
        <h2></h2>
        <table class="sell_table">
            <tr>

                <th>thông tin hóa đơn</th>
                <th>thông tin người nhận</th>
                <th>số lượng</th>
                <th>đơn giá</th>
                <th>thao tác</th>

            </tr>
        </table>
        <table class="sell_table">
            <?php $i=0;?>
            @foreach($hd as $item)
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
                    <td>
                        
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
{{--    <div class="page">{{ $sp->links()}}</div>--}}
@endsection
