@extends('layout.header_profile')

@section('profile_user')
    <?php $user = \Illuminate\Support\Facades\Auth::user(); ?>
            <div>
                <p>Hồ sơ của tôi</p>
                <p>Quản lý thông tin cá nhân</p>
            </div>
            <div class="div-content-user">
                <div>
                    <ul class="ul-user">
                        <li>Tên</li>
                        <li>email</li>
                        <li>số điện thoại</li>
                        <li>giới tính</li>
                        <li>ngày sinh</li>
                    </ul>
                </div>
                <div>
                    <form action="{{route('up_user')}}" method="post">
                        @csrf
                    <ul  class="ul-user">
                        <li>
                            <input name="username" class="input-user" type="text" value="{{$user->username}}">
                        </li>
                        <li>
                            <input class="input-user" type="text" value="{{$user->email}}" readonly>
                        </li>
                        <li>
                            <input name="so_dt_nd" class="input-user" type="text" value="{{$user->so_dt_nd}}">
                        </li>
                        <li>
                            <div class="sell_div1">

                                    <div class="sell_div1" id="gt">
                                        <input type="radio" id="nam" class="gioitinh" name="gioi_tinh" @if($user->gioi_tinh===0) checked @endif value="0">
                                        <label for="nam">nam</label><br>
                                        <input type="radio" class="gioitinh" id="nu" name="gioi_tinh" @if($user->gioi_tinh===1) checked @endif name="gioi_tinh" value="1">
                                        <label for="nu">nữ</label><br>
                                    </div>

                            </div>
                        </li>
                        <li>
                            <input name="ngay_sinh" class="input-user" type="date" value="{{$user->ngay_sinh}}">
                        </li>
                    </ul>
                        <div>
                            <input type="submit" value="Lưu">
                        </div>
                    </form>
                </div>
                <div>
                    <img src="{{asset('images/'.$user->image)}}">
                </div>
            </div>
        </div>
@endsection
