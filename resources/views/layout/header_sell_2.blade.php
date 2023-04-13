@extends('layout.header_sell')
@section('sell-index')

    <div class="sell_header_main">
        <ul class="sell_all_ul">
            <li>
                <a href="{{route('sell-index-all')}}">sản phẩm đang bán</a>
            </li>
            <li>
                <a href="{{route('sell-index-notduyet')}}">sản phẩm chờ duyệt</a>
            </li>
            <li>
                <a href="{{route('sell-index-hethang')}}">sản phẩm hết hàng</a>
            </li>
            <li>
                <a href="{{route('sell-index-delete')}}">sản phẩm vi phạm</a>
            </li>
        </ul>
    </div>
    <div class="sell-y">
        @yield('sell-index-all')
        @yield('sell-index-notduyet')
        @yield('sell-index-hethang')
        @yield('sell-index-delete')

    </div>
@endsection
