@extends('layout.header_profile')
@section('order_user')
    @if($hh !==null)
        <h2>Theo dõi hóa đơn</h2>
<div class="div-xacnhan">
    <div><p class="chudam text-giua">Thông tin hóa đơn</p></div>
    <div><p class="chudam text-giua">Số lượng</p></div>
    <div><p class="chudam text-giua">Đơn giá</p></div>
    <div><p class="chudam text-giua">Thành tiền</p></div>
    <div><p class="chudam text-giua">Thông tin người nhận</p></div>
    <div><p class="chudam text-giua">Thao tác</p></div>
</div>
<?php  $i=0 ?>
@foreach($hh as $value)
    <div>
        <div class="div-xacnhan2">
            <div>
                @foreach($value as $item)
                    <div class="div-xacnhan3">
                        <div class="chia_cot_table">
                            <div >
                                @if($item->anh_sp !==null)
                                    <img class="cart-img" src="{{$item->anh_sp}}">
                                @else
                                    <img class="cart-img" src="{{asset('images/user.png')}}">
                                @endif
                            </div>
                            <div class="text-giua">
                                <a href="{{route('sanpham.show',$item->ma_sp)}}">{{$item->ten_sp}}</a>
                                <br>
                                <a href="{{route('show_user',$item->ma_nguoidung)}}">shop: {{$item->username}}</a>
                            </div>
                        </div>
                        <div class="text-giua">
                            {{$item->so_luong_mua}}
                        </div>
                        <div class="text-giua">
{{--                            {{($item->gia_goc - $item->khuyen_mai)*$item->so_luong_mua}}--}}
                            <p>
                                {{
                                  number_format(($item->gia_goc - $item->khuyen_mai)*$item->so_luong_mua, 0, '', ',')
                                }}
                                <span> VNĐ</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div  class="text-giua">
                <p>
                    {{
                      number_format($tong[$i], 0, '', ',')
                    }}
                    <span> VNĐ</span>
                </p>

            </div>
            <div>
                <p>tên: {{$value[0]->ten_nhan}}</p>
                <p>số dt: {{$value[0]->so_dt_nhan}}</p>
                <p>địa chỉ: {{$value[0]->dia_chi_nhan}}</p>
            </div>
            <div class="text-giua">
                <button class="button-cart" type="submit" name="submit" ><a href="{{route('confim-wait',$value[0]->ma_hoadon)}}">xác nhận</a></button>
                <button class="button-cart" type="submit" name="submit" ><a href="{{route('huy_xacnhan',$value[0]->ma_hoadon)}}">hủy</a></button>
            </div>
        </div>
    </div>
    <div><p>{{$value[0]->ten_vc}} - {{$value[0]->don_gia_vc}}</p></div>
        <?php $i++; ?>
@endforeach
    @endif

<?php  $j=0 ?>

    @if($hh2 !==null)
@foreach($hh2 as $value)
    <div>
        <div class="div-xacnhan2">
            <div>
                @foreach($value as $item)
                    <div class="div-xacnhan3">
                        <div class="chia_cot_table">
                            <div>
                                @if($item->anh_sp !==null)
                                    <img class="cart-img" src="{{$item->anh_sp}}">
                                @else
                                    <img class="cart-img" src="{{asset('images/user.png')}}">
                                @endif
                            </div>
                            <div class="text-giua">
                                <a href="{{route('sanpham.show',$item->ma_sp)}}">{{$item->ten_sp}}</a>
                                <br>
                                <a href="{{route('show_user',$item->ma_nguoidung)}}">shop: {{$item->username}}</a>
                            </div>
                        </div>
                        <div class="text-giua">
                            {{$item->so_luong_mua}}
                        </div>
                        <div class="text-giua">
                            <p>
                                {{
                                  number_format(($item->gia_goc - $item->khuyen_mai)*$item->so_luong_mua, 0, '', ',')
                                }}
                                <span> VNĐ</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div  class="text-giua">

                <p>
                    {{
                      number_format($tong1[$j], 0, '', ',')
                    }}
                    <span> VNĐ</span>
                </p>

            </div>
            <div>
                <p>tên: {{$value[0]->ten_nhan}}</p>
                <p>số dt: {{$value[0]->so_dt_nhan}}</p>
                <p>địa chỉ: {{$value[0]->dia_chi_nhan}}</p>
            </div>
            <div class="text-giua">
                @if($value[0]->trang_thai == 2)
                    <p class="session-status">Chờ Xác nhận </p>
                @elseif($value[0]->trang_thai == 3)
                    <p class="session-status">Đang giao</p>
                @elseif($value[0]->trang_thai == 4)
                    <p class="session-status">Đã giao</p>
                @elseif($value[0]->trang_thai == 5)
                    <p class="session-status">Hoàn tiền</p>
                @endif
            </div>
        </div>
    </div>
    <div><p>{{$value[0]->ten_vc}} - {{$value[0]->don_gia_vc}}</p></div>
        <?php $j++; ?>
@endforeach
    @endif

{{--            <table class="sell_table">--}}
{{--                <tr>--}}


{{--                    <td>thông tin hóa đơn</td>--}}
{{--                    <td>số lượng</td>--}}
{{--                    <td>đơn giá</td>--}}
{{--                    <td>thành tiền</td>--}}
{{--                    <td>thông tin người nhận</td>--}}
{{--                    <td>thao tác</td>--}}

{{--                </tr>--}}
{{--            </table>--}}
{{--            <table class="sell_table">--}}
{{--                @foreach($hh as $value)--}}
{{--                @foreach($value as $item)--}}

{{--                        <tr class="tr">--}}
{{--                            <td>--}}
{{--                                <div class="chia_cot_table">--}}
{{--                                    <div>--}}
{{--                                        @if($item->anh_sp !==null)--}}
{{--                                            <img class="cart-img" src="{{$item->anh_sp}}">--}}
{{--                                        @else--}}
{{--                                            <img class="cart-img" src="{{asset('images/user.png')}}">--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        {{$item->ten_sp}}--}}
{{--                                        <p>{{$item->ten_vc}} - {{$item->don_gia_vc}}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                {{$item->so_luong_mua}}--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                {{($item->gia_goc - $item->khuyen_mai)*$item->so_luong_mua}}--}}

{{--                            </td>--}}

{{--                               @endforeach--}}
{{--                            <td>--}}
{{--                                {{$tong[$i]}}--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <p>tên: {{$value[0]->ten_nhan}}</p>--}}
{{--                                <p>số dt: {{$value[0]->so_dt_nhan}}</p>--}}
{{--                                <p>địa chỉ: {{$value[0]->dia_chi_nhan}}</p>--}}
{{--                            </td>--}}

{{--                            <td>--}}
{{--                                <button class="button-cart" type="submit" name="submit" ><a href="{{route('confim-wait',$value[0]->ma_hoadon)}}">xác nhận</a></button>--}}
{{--                                <button class="button-cart" type="submit" name="submit" ><a href="{{route('huy_xacnhan',$value[0]->ma_hoadon)}}">hủy</a></button>--}}
{{--                             </td>--}}

{{--                        </tr>--}}
{{--                    <tr>--}}
{{--                        <td colspan="6">--}}
{{--                            <div class="tr"></div>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <?php $i++; ?>--}}
{{--                @endforeach--}}

{{--            </table>--}}


@endsection
