<div>
    <div>
        <h2>xin chaof {{$user->username}}</h2>
        <p>
            vui longf nhan vao nut kich hoat tai khoan
        </p>
        <p>
            <a href="{{route('nguoidung.active',['user'=>$user->id,'token'=>$user->token])}}"> xacs nhan</a>
        </p>
    </div>
</div>
