<div>
<h1>Chào mừng bạn đến với nơi bán sản phẩm</h1>
    <h2>trước tiên bạn cần kích hoạt tài khoản trở thành người bán</h2>
</div>
<div>
    <form action="">
        <ul>
            <li>Email</li>
            <li><input type="text" readonly value="{{$user->email}}"></li>
        </ul>
        <ul>
            <li>số điện thoại</li>
            <li><input type="text" readonly name="so_dt_nd" value=""></li>
        </ul>
        <ul>
            <li>
                <input type="checkbox" name="checkbox"> Tôi đồn ý với điều khoản <a href="#">quy định về người bán</a> này
            </li>
        </ul>
        <ul>
            <li><button class="btn btn-primary" type="submit">lưu</button></li>
            <li><a href="javascript:window.history.back(-1);">trở về</a></li>

        </ul>

    </form>
</div>
