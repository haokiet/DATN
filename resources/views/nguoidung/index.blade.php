@include('layout.header2')

<div class=" main_register">
    <div class="register_left">
        <?php $img = 'img_register.png'; ?>
        <img class="img_register" src="{{asset('images/'.$img)}}">
    </div>
    <div class="register_right">
        <form action="{{route('check_login')}}" method="post" enctype="multipart/form-data">
            @csrf
            <h2>DANG NHAP</h2>
            @if (session('thongbao'))
                <div class="session-status">
                    {{ session('thongbao') }}
                </div>
            @endif
            <table class="register_table">
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
                        <span style="font-size: 20px">Password</span>
                    </td>
                    <td>
                        <input class="form-control" id="password" type="password" required name="password" placeholder="">
                    </td>

                </tr >
                <tr class="regis_tr">
                    <td colspan="2">

                    </td>
                </tr>
            </table>
            <div><button class="btn btn-primary" type="submit">Đăng nhập</button>
                <button  class="btn btn-primary"> <a href="{{route('home')}}">Trở về</a></button></div>
        </form>

    </div>
</div>
