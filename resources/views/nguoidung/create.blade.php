@include('layout.header2')

<div class="text-giua main_giua ">
    <div class="child body-home boder">
        <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
            @csrf
            <h2>ĐĂNG KÝ</h2>
            @if (session('thongbao'))
                <div class="session-status">
                    {{ session('thongbao') }}
                </div>
            @endif
            <table class="register_table">
                <tr class="regis_tr" >
                    <td>
                        <span style="font-size: 20px">Tên người dùng</span>
                    </td>
                    <td colspan="2">
                        <input class="form-control" type="text" required name="username" placeholder="tên người dùng">
                    </td>

                </tr>
                <tr class="regis_tr">
                    <td>
                        <span style="font-size: 20px">Email</span>
                    </td>
                    <td colspan="2">
                        <input class="form-control" type="text" required name="email" placeholder="email">
                    </td>

                </tr>

                <tr class="regis_tr">
                    <td>
                        <span style="font-size: 20px">Mật khẩu</span>
                    </td>
                    <td>
                        <input class="form-control" id="password" type="password" required name="password" placeholder="mật khẩu">
                    </td>

                </tr >
                <tr class="regis_tr">
                    <td>
                        <span style="font-size: 20px">Xác nhận mật khẩu</span>
                    </td>
                    <td>
                        <input class="form-control" id="password" type="password" required name="Re_password" placeholder=" nhập lại mật khẩu">
                    </td>

                </tr >

                </tr>


                </tr>
            </table>
            <div class="text-giua">
                <button type="reset" class="btn btn-primary"><a href="{{route('home')}}">Trở về</a></button>
                <button class="btn btn-primary" type="submit">Đăng ký</button>
                <button type="reset" class="btn btn-primary">Thiết lập lại</button>

            </div>

    </div>
</div>
