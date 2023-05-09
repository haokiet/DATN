@extends('layout.header_profile')
@section('order_user')

            <table class="sell_table">
                <tr>


                    <td>thông tin hóa đơn</td>
                    <td>số lượng</td>
                    <td>đơn giá</td>
                    <td>thành tiền</td>
                    <td>thông tin người nhận</td>
                    <td>thao tác</td>

                </tr>
            </table>
            <table class="sell_table">
                <?php $s=array(); $s[0]=0; $i = 0; $j=1;?>
                @foreach($hh as $value)
                @foreach($value as $item)

                        <tr>
                            <td>
                                @if($item->anh_sp !==null)
                                    <img class="cart-img" src="{{$item->anh_sp}}">
                                @else
                                    <img class="cart-img" src="{{asset('images/user.png')}}">
                                @endif

                            </td>
                            <td>
                                {{$item->so_luong_mua}}
                            </td>
                            <td>
                                {{($item->gia_goc - $item->khuyen_mai)*$item->so_luong_mua + $item->don_gia_vc}}

                            </td>

                               @endforeach
                            <td>
                                {{$tong[$i]}}
                            </td>
                            <td>
                                <p>tên: {{$value[0]->ten_nhan}}</p>
                                <p>số dt: {{$value[0]->so_dt_nhan}}</p>
                                <p>địa chỉ: {{$value[0]->dia_chi_nhan}}</p>
                            </td>

                            <td>
                                <button class="button-cart" type="submit" name="submit" ><a href="{{route('confim-wait',$value[0]->ma_hoadon)}}">xác nhận</a></button>
                             </td>
                        </tr>
                    <?php $i++; ?>
                @endforeach

            </table>


@endsection
