
<html>
<link rel="stylesheet" href="../../css/app.css">

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<?php $user = \Illuminate\Support\Facades\Auth::user(); ?>
<nav class="nav">
    <div class="header">
        <div class="header-content-1">

            <div>
                <a href="{{route('home')}}"> <h1 class="search" >Rập may <span style="font-size: 60%">Kênh người bán</span></h1> </a>
            </div>
            <div class="sell-img">
                <div class="dropdown">
                    @if ($user->image!==null)
                        <a  href="#"><img class="img-header" src="{{$user->image}}">{{$user->username}}</a>
                    @else
                        <a class="dropbtn" href="#"><img class="img-header" src="{{asset('images/user.png')}}">{{$user->username}}</a>
                    @endif
                    <div class="dropdown-content">
                        <a href="{{route('logout')}}">Đăng xuất</a>
                    </div>
                </div>

            </div>
        </div>

    </div>

</nav>
    <div class="body-home">
        <div class="sell-col scroll-left">
            <ul>
                <li class="li_h">
                    <div>
                        <p class='fa fa-book'></p> <span>Quản lý sản phẩm</span>
                    </div>
                    <ul>
                        <li class="li_header">
                            <a href="{{route('sell-index-all')}}">Tất cả sản phẩm</a>
                        </li>
                        <li class="li_header">
                            <a href="{{route('sell_create_sp')}}">Thêm sản phẩm</a>
                        </li>
                        <li class="li_header">
                            <a href="{{route('sell-index-delete')}}">Sản phẩm vi phạm</a>
                        </li>
                    </ul>
                </li>
                <li class="li_h">
                    <div>
                        <p class='fa fa-shopping-cart'></p>  <span>Quản lý đơn hàng</span>
                    </div>
                    <ul>
                        <li class="li_header">
                            <a href="{{route('order_sell_all')}}">Tất cả đơn hàng</a>
                        </li>
{{--                        <li class="li_header">--}}
{{--                            <a href="{{route('order_sell_delete')}}">đơn hủy</a>--}}
{{--                        </li>--}}
                        <li class="li_header">
                            <a href="{{route('order_sell_money_away')}}">Trả hàng/hoàn tiền</a>
                        </li>
                    </ul>
                </li>
                <li class="li_h">
                    <div>
                        <p class='fa fa-bank'></p> <spa>Thiết lập shop</spa>
                    </div>
                    <ul>
                        <li class="li_header">
                            <a href="{{route('up')}}">Hồ sơ shop</a>
                        </li>
                        <li class="li_header">
                            <a href="{{route('logout')}}">Đăng xuất</a>
                        </li>
                    </ul>
                </li>
                <li class="li_h">
                    <div>
                        <p class='fa fa-database'></p>  <span>Dữ liệu</span>
                    </div>
                    <ul>
{{--                        <li class="li_header">--}}
{{--                            <a href="{{route('sell_home')}}">Phân tích bán hàng</a>--}}
{{--                        </li>--}}
                        <li class="li_header">
                            <a href="{{route('sell_home')}}">Hiệu quả hoạt động</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="sell-col scroll-right">
            @yield('sell-home')
            @yield('sell-index')
            @yield('them_sp')
            @yield('header_sell_order')
            @yield('edit_sp')
            @yield('sell-order-delete')
            @yield('sell-order-money_away')
            @yield('up_shop')

        </div>
    </div>

</html>
