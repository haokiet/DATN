@extends('layout.header_order')
@section('sell-order-wait')
    <div>

        <h2>{{$hd[0]->ten_sp}}</h2>
        <div class="sell-chitiet-order">
            <div class="text-giua chudam">Mã hóa đơn</div>
            <div class="text-giua chudam">Thông tin hóa đơn</div>
            <div class="text-giua chudam">Thông tin người nhận</div>
            <div class="text-giua chudam">Số lượng</div>
            <div class="text-giua chudam">Đơn giá</div>
        </div>
        @foreach($hd as $item)
        <div class="sell-chitiet-order">
            <div class="text-giua">{{$item->ma_hoadon}}</div>
            <div class="chia_cot_table text-giua">
                <div>
                    <img class="cart-img"  src="{{$item->anh_sp}}">
                </div>
                <div>
                    {{$item->ten_sp}}
                </div>
            </div>
            <div class="text-giua">
                <p>tên: {{$item->ten_nhan}}</p>
                <p>số dt: {{$item->so_dt_nhan}}</p>
                <p>địa chỉ: {{$item->dia_chi_nhan}}</p>
            </div>
            <div class="text-giua">
                {{$item->so_luong_mua}}
            </div>
            <div class="text-giua">
                {{($item->gia_goc - $item->khuyen_mai)*$item->so_luong_mua}} vnd
            </div>
        </div>
        @endforeach

    </div>
    <div class="margin-top">
        <button class="btn-sell"><a href="javascript:window.history.back(-1);">Trở về</a></button>
    </div>
{{--    <div class="page">{{ $sp->links()}}</div>--}}
@endsection
