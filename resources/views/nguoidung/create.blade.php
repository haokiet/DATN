@include('layout.header2')

<div class=" main_register ">
    <div class="register_left body-home">
        <?php $img = 'img_register.png'; ?>
        <img class="img_register" src="{{asset('images/'.$img)}}">
    </div>
    <div class="register_right body-home">
        <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
            @csrf
            <h2>Đăng ký</h2>
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
                    <td>
                        <input class="form-control" type="text" required name="username" placeholder="">
                    </td>

                </tr>
                <tr class="regis_tr">
                    <td>
                        <span style="font-size: 20px">email</span>
                    </td>
                    <td>
                        <input class="form-control" type="text" required name="email" placeholder="">
                    </td>

                </tr>

                <tr class="regis_tr">
                    <td>
                        <span style="font-size: 20px">mật khẩu</span>
                    </td>
                    <td>
                        <input class="form-control" id="password" type="password" required name="password" placeholder="">
                    </td>

                </tr >
                <tr class="regis_tr">
                    <td>
                        <span style="font-size: 20px">xác nhận mật khẩu</span>
                    </td>
                    <td>
                        <input class="form-control" id="password" type="password" required name="Re_password" placeholder="">
                    </td>

                </tr >

                </tr>
                <tr class="regis_tr">
                    <td colspan="3">
                        <button type="reset" class="btn btn-primary"><a href="{{route('home')}}">Trở về</a></button>
                        <button class="btn btn-primary" type="submit">Đăng ký</button>
                        <button type="reset" class="btn btn-primary">thiết lập lại</button>

                    </td>

                </tr>
            </table>
        </form>

    </div>
</div>
