@extends('layout.header')

@section('header_profile_user')
    <?php $user = \Illuminate\Support\Facades\Auth::user(); ?>
    <div class="body-home">
        <div class="sell-col scroll-left">
            <div class="div-user">
                <div>
                    @if ($user->image!==null)
                        <img class="img-avata" src="{{asset('images/'.$user->image)}}">
                    @else
                        <img class="img-avata" src="{{asset('images/user.png')}}">
                    @endif
                </div>
                <div id="username">
                    {{$user->username}}
                    <p>chỉnh sửa hồi sơ</p>
                </div>
            </div>
            <div class="div-left">
                <ul class="ul-user-left">
                    <li>
                        <a href="{{route('profile_user')}}">tài khoản của tôi</a>
                    </li>
                    <li>
                        <a href="{{route('buy_show-wait')}}">đơn mua hàng</a>
                    </li>
                    <li>
                        <a>Thông báo</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sell-col scroll-right ri">
            @yield('profile_user')
            @yield('order_user')
        </div>
    </div>
@endsection
