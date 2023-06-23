@extends('layout.header_admin')
@section('chitiet_user')
    <div class="show_sp">
        @if(session('thongbao'))
            <div class="session-status text-giua">{{session('thongbao')}}</div>
        @endif
        <div id="box">
           <h2>Bạn có chắc chắn xóa người dùng {{$us->username}} không></h2>
            <br>
            <div>
                <button class="btn-sell" id="confim"><a href="{{route('delete_user_admin',$us->id)}}">Xóa</a></button>
                <button class="btn-sell" id="trolai">Trở lại</button>
            </div>
        </div>
            <h2>Chi tiết người dùng</h2>
        <div class="show-lr body-home">
            <div class="khung_sp" >
                @if($us->image !==null)
                    <img class="ct_anh" src="{{$us->image}}">
                @else
                    <img class="ct_anh" src="{{asset('images/user.png')}}">
                @endif

            </div>

            <div>
                <h2>Họ tên: {{$us->username}}</h2>
                <div>
                    @if($us->dia_chi !==null)
                        <h3>Địa chỉ: {{$us->dia_chi}}</h3>
                    @endif
                </div>
                <div>
                    @if($us->so_dt_nd !==null)
                        <h3>Số điện thoại: {{$us->so_dt_nd}}</h3>
                    @endif
                </div>
                <div>
                    @if($us->gioi_tinh !==null)
                        <h3>
                            Giới tính:  @if($us->gioi_tinh ===0)
                                Nam
                            @elseif($us->gioi_tinh ===1)
                                Nữ
                            @endif
                        </h3>
                    @else
                        <h3>Giới tính: không xác định</h3>
                    @endif
                </div>
                <div>
                    <h3>Tổng sản phẩm đang bán: {{$dem}} sản phẩm</h3>
                </div>
                <form method="post" action="{{route('update_users_admin',$us->id)}}">
                    @csrf
                <div class="display_flex">
                    <h3>Quyền: </h3>
                    <input type="radio" id="nomal" class="gioitinh" name="role" @if($us->role===0) checked @endif value="0">
                    <label for="nomal"><h3>Nomal</h3></label><br>
                    <input type="radio" class="gioitinh" id="shipper" name="role" @if($us->role===1) checked @endif name="role" value="1">
                    <label for="shipper"><h3>Shippe</h3></label><br>
                    <input type="radio" class="gioitinh" id="admin" name="role" @if($us->role===2) checked @endif name="role" value="2">
                    <label for="admin"><h3>Admin</h3></label><br>
                </div>
                    <div>
                        <input class="btn-sell" type="submit" value="Cập nhật">
                        <button class="btn-sell" id="xoa"><a href="#">Xóa</a></button>
                        <button class="btn-sell"><a href="{{route('all_users_admin')}}">Trở về</a></button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function (){
            $("#box").hide();
        })
            $("#xoa").click(function(){
                $("#box").show();
                $(".show-lr").hide();
            });
        $("#trolai").click(function(){
            $("#box").hide();
            $(".show-lr").show();
        });

    </script>
@endsection
