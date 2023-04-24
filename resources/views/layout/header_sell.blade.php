
<html>
<link rel="stylesheet" href="../../css/app.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<nav class="nav">
    <div class="header">
        <div class="header-content-1">
            <div>
                <a href="{{route('home')}}"> <h1 class="search" >Rap may <span style="font-size: 60%">kênh người bán</span></h1> </a>
            </div>
            <div class="sell-img">
                <div>
                    <?php $user=\Illuminate\Support\Facades\Auth::user();
                    if ($user->image!==null)
                    {
                        ?><img class="img-header" src="{{asset('images/'.$user->image)}}"> <?php
                    }
                    else
                    {
                        ?> <img class="img-header" src="{{asset('images/user.png')}}"> <?php
                    }
                    ?>
                </div>
                <div>
                    <p class="search"><?php echo $user->username;?></p>
                </div>

        </div>

    </div>

</nav>
<div class="sell-main">
    <div class="sell-col scroll-left">
        <ul>
            <li class="li_h">
                <div>
                    <spa>Quản lý sản phẩm</spa>
                </div>
                <ul>
                    <li class="li_header">
                        <a href="{{route('sell-index-all')}}">tất cả sản phẩm</a>
                    </li>
                    <li class="li_header">
                        <a href="{{route('sell_create_sp')}}">thêm sản phẩm</a>
                    </li>
                    <li class="li_header">
                        <a href="{{route('sell-index-delete')}}">sản phẩm vi phạm</a>
                    </li>
                </ul>
            </li>
            <li class="li_h">
                <div>
                    <spa>Quản lý đơn hàng</spa>
                </div>
                <ul>
                    <li class="li_header">
                        <a href="{{route('order_sell_all')}}">tất cả đơn hàng</a>
                    </li>
                    <li class="li_header">
                        <a href="{{route('order_sell_delete')}}">đơn hủy</a>
                    </li>
                    <li class="li_header">
                        <a href="{{route('order_sell_money_away')}}">trả hàng/hoàn tiền</a>
                    </li>
                </ul>
            </li>
            <li class="li_h">
                <div>
                    <spa>Thiết lập shop</spa>
                </div>
                <ul>
                    <li class="li_header">
                        <a href="{{route('up')}}">hồ sơ shop</a>
                    </li>
                    <li class="li_header">
                        <a href="#">địa chỉ</a>
                    </li>
                    <li class="li_header">
                        <a href="#">cài đặt sản phẩm sản phẩm</a>
                    </li>
                </ul>
            </li>
            <li class="li_h">
                <div>
                    <span>Dữ liệu</span>
                </div>
                <ul>
                    <li class="li_header">
                        <a href="#">Phân tích bán hàng</a>
                    </li>
                    <li class="li_header">
                        <a href="#">Hiệu quả hoạt động</a>
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
