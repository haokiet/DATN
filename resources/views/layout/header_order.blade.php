@extends('layout.header_sell')
@section('header_sell_order')

    <div class="sell_header_main">
        <ul class="sell_all_ul">
            <li>
                <a href="{{route('order_sell_all')}}">tất cả hóa đơn</a>
            </li>
            <li>
                <a href="{{route('order_sell_wait')}}">chờ xác nhận</a>
            </li>
            <li>
                <a href="{{route('order_sell_giving')}}">chờ lấy hàng</a>
            </li>
            <li>
                <a href="{{route('order_sell_gave')}}">đã giao</a>
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