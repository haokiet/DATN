@extends('layout.header_admin')
@section('create_user')
    @if(session('thongbao'))
        <div class="session-status">{{session('thongbao')}}</div>
    @endif
    <form action="{{route('store_user_admin')}}" method="post" enctype="multipart/form-data">
        <div class="div-content-user">
            <div>
                <ul class="ul-user">
                    <li>Họ tên:</li>
                    <li>Tên đăng nhập: </li>
                    <li>Địa chỉ</li>
                    <li>Giới tính</li>
                    <li>Ngày sinh</li>
                    <li>Số điện thoại:</li>
                    <li>Quyền người dùng:</li>
                    <li>Mật khẩu</li>
                    <li>Nhập lại mật khẩu</li>
                </ul>
            </div>
            <div>

                @csrf
                <ul  class="ul-user">
                    <li>
                        <input name="username" class="input-user" type="text" required value="">
                    </li>
                    <li>
                        <input name="email" class="input-user" type="text" required value="">
                    </li>
                    <li>
                        <input name="dia_chi" class="input-user" type="text" value="" required>
                    </li>
                    <li>
                        <div class="sell_div1">

                            <div class="sell_div1" id="gt">
                                <input type="radio" id="nam" class="gioitinh" checked name="gioi_tinh" value="0">
                                <label for="nam">nam</label><br>
                                <input type="radio" class="gioitinh" id="nu" name="gioi_tinh" name="gioi_tinh" value="1">
                                <label for="nu">nữ</label><br>
                            </div>

                        </div>
                    </li>
                    <li>
                        <input name="ngay_sinh" class="input-user" type="date" value="" required>
                    </li>
                    <li>
                        <input name="so_dt_nd" class="input-user" type="text" value="" required>
                    </li>
                    <li>
                        <div class="display_flex">
                            <input type="radio" id="nomal" class="gioitinh" name="role" checked value="0">
                            <label for="nomal">Nomal</label>
                            <input type="radio" class="gioitinh" id="shipper" name="role"  name="role" value="1">
                            <label for="shipper">Shippe</label>
                            <input type="radio" class="gioitinh" id="admin" name="role"  name="role" value="2">
                            <label for="admin">Admin</label>
                        </div>
                    </li>
                    <li>
                        <input class="input-user" type="password" id="pass" value="" name="password" required >
                    </li>
                    <li>
                        <input class="input-user" type="password" id="repass" value="" name="repassword" required >
                    </li>
                    <li><div class="pading-am corso" id="s1"><p id="showpass">hiện mật khẩu</p> </div>
                        <div class="pading-am corso" id="s2"><p id="showpass2">hiện mật khẩu</p> </div></li>
                </ul>

                <div id="them">
                    <input class="btn-sell"  type="submit" value="Thêm">
                </div>

            </div>
            <div>
                    <img src="" class="preview preview-img" id="preview">
                <input  name="anh_nd" type="file" class="input" />

            </div>
        </div>
    </form>
    </div>

    <script src="../../script/script.js"></script>
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>--}}
    <script>

    </script>
@endsection
