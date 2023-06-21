@extends('layout.header_profile')
@section('profile_user')
    <?php $user = \Illuminate\Support\Facades\Auth::user(); ?>
            <div>

                <h3>Quản lý thông tin cá nhân</h3>
            </div>
    <form action="{{route('up_user')}}" method="post" enctype="multipart/form-data">
            <div class="div-content-user">
                <div>
                    <ul class="ul-user">
                        <li>Họ tên</li>
                        <li>Email</li>
                        <li>Số điện thoại</li>
                        <li>Địa chỉ</li>
                        <li>Giới tính</li>
                        <li>Ngày sinh</li>
                    </ul>
                </div>
                <div>

                        @csrf
                    <ul  class="ul-user">
                        <li>
                            <input name="username" class="input-user" type="text" value="{{$user->username}}">
                        </li>
                        <li>
                            <input class="input-user" type="text" value="{{$user->email}}" readonly>
                        </li>
                        <li>
                            <input name="so_dt_nd" id="mobile" class="input-user" MAXLENGTH="11" type="text" value="{{$user->so_dt_nd}}">
                        </li>
                        <li>
                            <input name="dia_chi" class="input-user" type="text" value="{{$user->dia_chi}}">
                        </li>
                        <li>
                            <div class="sell_div1">

                                    <div class="sell_div1" id="gt">
                                        <input type="radio" id="nam" class="gioitinh" name="gioi_tinh" @if($user->gioi_tinh===0) checked @endif value="0">
                                        <label for="nam">Nam</label><br>
                                        <input type="radio" class="gioitinh" id="nu" name="gioi_tinh" @if($user->gioi_tinh===1) checked @endif name="gioi_tinh" value="1">
                                        <label for="nu">Nữ</label><br>
                                    </div>

                            </div>
                        </li>
                        <li>
                            <input name="ngay_sinh" class="input-user" type="date" value="{{$user->ngay_sinh}}">
                        </li>
                    </ul>
                        <div>
                            <input type="submit" class="btn-sell " value="Lưu">
                        </div>

                </div>
                <div>


                    <div class="profile-img">
                        @if($user->image !==null)
                            <label for="anh_nd" class="corso"><img src="{{$user->image}}" class="preview preview-img" id="preview"></label>
                        @else
                            <label for="anh_nd" class="corso"><img src="{{asset('images/user.png')}}" class="preview preview-img" id="preview"></label>
                        @endif
                        <input id="anh_nd"  name="anh_nd" hidden type="file" class="input" accept=".jpg, .png"/>
                    </div>
                </div>
            </div>
    </form>
        </div>
    <script src="../../script/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('mouseout','#mobile', function() {
                var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
                var mobile = $('#mobile').val();
                if(mobile !==''){
                    if (vnf_regex.test(mobile) == false)
                    {
                        alert('Số điện thoại của bạn không đúng định dạng!');
                    }
                }else{
                    alert('Bạn chưa điền số điện thoại!');
                }
            });
        });
    </script>
@endsection

