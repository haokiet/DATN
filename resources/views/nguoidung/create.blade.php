@include('layout.header2')

<div class=" main_register">
    <div class="register_left">
        <?php $img = 'img_register.png'; ?>
        <img class="img_register" src="{{asset('images/'.$img)}}">
    </div>
    <div class="register_right">
        <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
            @csrf
            <h2>ddawng kys</h2>

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
                        <input class="form-control" id="password" type="text" required name="password" placeholder="">
                    </td>

                </tr >
                <tr class="regis_tr">
                    <td>
                        <span style="font-size: 20px">xác nhận mật khẩu</span>
                    </td>
                    <td>
                        <input class="form-control" id="password" type="text" required name="Re_password" placeholder="">
                    </td>

                </tr >

                </tr>
                <tr class="regis_tr">
                    <td>
                        <button class="btn btn-primary" type="submit">lưu</button>
                        <button type="reset" class="btn btn-primary">reset</button>
                    </td>

                </tr>
            </table>
        </form>
        <a href="javascript:window.history.back(-1);">Trở về</a>
    </div>
</div>
