
<html>
<link rel="stylesheet" href="../../css/app.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<nav class="nav">
    <div class="header">
        <div class="header-content-3">
            <div>
                <a href="{{route('shipper-all-order')}}"><h1>Rap may <span style="font-size: 60%">shipper</span></h1></a>
            </div>
            <div class="giohang">
                <a href="{{route('shipper-all-order')}}">Tất cả hóa đơn</a>
            </div>
            <div class="giohang">
                <a href="{{route('shipper-resive-order')}}">Hóa đơn đã nhận</a>
            </div>
            <div class="giohang">
                @if(\Illuminate\Support\Facades\Auth::check())
                        <?php $user=\Illuminate\Support\Facades\Auth::user();?>


                    <div class="dropdown">
                        @if ($user->image!==null)
                            <a  href="#"><img class="img-header2" src="{{$user->image}}">{{$user->username}}</a>
                        @else
                            <a class="dropbtn" href="#"><img class="img-header2" src="{{asset('images/user.png')}}">{{$user->username}}</a>
                        @endif
                        <div class="dropdown-content">
                            <a href="{{route('logout')}}">đăng xuất</a>
                            <a href="{{route('profile_user')}}">hồ sơ</a>
                        </div>
                    </div>

                @else
                    <a href="{{route('login')}}">đăng nhập</a>|
                    <a href="{{route('nguoidung.create')}}">đăng ký</a>
                @endif
            </div>
        </div>

    </div>

</nav>

</html>
