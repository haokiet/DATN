@extends('layout.header_sell')
@section('header_sell_order')

    <div class="sell_header_main">
        <ul class="sell_all_ul">
            <li>
                <a href="{{route('order_sell_all')}}">Tất cả hóa đơn</a>
            </li>
            <li>
                <a href="{{route('order_sell_wait')}}">Chờ xác nhận</a>
            </li>
            <li>
                <a href="{{route('order_sell_giving')}}">Chờ lấy hàng</a>
            </li>
            <li>
                <a href="{{route('order_sell_gave')}}">Đã giao</a>
            </li>
        </ul>
    </div>
    <div class="sell-y">
        @yield('sell-order-all')
        @yield('sell-order-wait')
        @yield('sell-order-giving')
        @yield('sell-order-gave')
    </div>
@endsection
