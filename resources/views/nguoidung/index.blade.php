@include('layout.header2')

<div class="text-giua main_giua">
    <div class="child body-home boder">
        <form action="{{route('check_login')}}" method="post" enctype="multipart/form-data">
            @csrf
            <h2>ĐĂNG NHẬP</h2>
            @if (session('thongbao'))
                <div class="session-status">
                    {{ session('thongbao') }}
                </div>
            @endif
            <table class="register_table">
                <tr class="regis_tr">
                    <td>
                        <span style="font-size: 20px">Email</span>
                    </td>
                    <td colspan="5">
                        <input class="form-control" type="text" required name="email" placeholder="email">
                    </td>

                </tr>

                <tr class="regis_tr">
                    <td>
                        <span style="font-size: 20px">Mật khẩu</span>
                    </td>
                    <td colspan="5">
                        <input class="form-control" id="password" type="password" required name="password" placeholder="mật khẩu">
                    </td>

                </tr >
                <tr class="regis_tr">
                    <td colspan="2">

                        <input type="checkbox" name="remember" value="1">
                        <label for="remember">Nhớ tài khoản</label>
                    </td>
                </tr>
            </table>
            <div class="text-giua"><button class="btn btn-primary" type="submit">Đăng nhập</button>
                <button  class="btn btn-primary"> <a href="{{route('home')}}">Trở về</a></button></div>
        </form>

    </div>
</div>
