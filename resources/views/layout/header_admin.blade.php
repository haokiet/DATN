
<html>
<link rel="stylesheet" href="../../css/app.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<?php $user = \Illuminate\Support\Facades\Auth::user(); ?>
<nav class="nav">
    <div class="header">
        <div class="header-content-1">
            <div>
                <a href="{{route('home')}}"> <h1 class="search" >Rap may <span style="font-size: 60%">Admin</span></h1> </a>
            </div>
            <div class="sell-img">
                <div class="dropdown">
                    @if ($user->image!==null)
                        <a  href="#"><img class="img-header" src="{{$user->image}}">{{$user->username}}</a>
                    @else
                        <a class="dropbtn" href="#"><img class="img-header" src="{{asset('images/user.png')}}">{{$user->username}}</a>
                    @endif
                    <div class="dropdown-content">
                        <a href="{{route('logout')}}">đăng xuất</a>
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
                    <span>Quản lý sản phẩm</span>
                </div>
                <ul>
                    <li class="li_header">
                        <a href="{{route('admin_all')}}">tất cả sản phẩm</a>
                    </li>
                </ul>
            </li>
            <li class="li_h">
                <div>
                    <span>Quản lý người dùng</span>
                </div>
                <ul>
                    <li class="li_header">
                        <a href="{{route('admin_all')}}">tất cả người dùng</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="sell-col scroll-right">
        @yield('admin_duyet')
        @yield('admin_all')

    </div>
</div>

</html>
