<div>
    <div>
        <h2>Xin chào {{$user->username}}</h2>

        <p>
            Chào mừng bạn đến với sàn giao dịch rập may
        </p>
        <p>
            Để kích hoạt tài khoản sử dụng bạn vui lòng nhấn vào nút xác nhận phía dưới. Chúc bạn sử dụng sàn giao dịch thành công!
        </p>
        <p>
            <button><a href="{{route('nguoidung.active',['user'=>$user->id,'token'=>$user->token])}}">Xác nhận đăng ký tài khoản</a></button>
        </p>
    </div>
</div>
