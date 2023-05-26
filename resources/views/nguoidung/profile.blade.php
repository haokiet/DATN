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
                        <li>Tên</li>
                        <li>email</li>
                        <li>số điện thoại</li>
                        <li>địa chỉ</li>
                        <li>giới tính</li>
                        <li>ngày sinh</li>
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
                            <input name="so_dt_nd" class="input-user" MAXLENGTH="11" type="text" value="{{$user->so_dt_nd}}">
                        </li>
                        <li>
                            <input name="dia_chi" class="input-user" type="text" value="{{$user->dia_chi}}">
                        </li>
                        <li>
                            <div class="sell_div1">

                                    <div class="sell_div1" id="gt">
                                        <input type="radio" id="nam" class="gioitinh" name="gioi_tinh" @if($user->gioi_tinh===0) checked @endif value="0">
                                        <label for="nam">nam</label><br>
                                        <input type="radio" class="gioitinh" id="nu" name="gioi_tinh" @if($user->gioi_tinh===1) checked @endif name="gioi_tinh" value="1">
                                        <label for="nu">nữ</label><br>
                                    </div>

                            </div>
                        </li>
                        <li>
                            <input name="ngay_sinh" class="input-user" type="date" value="{{$user->ngay_sinh}}">
                        </li>
                    </ul>
                        <div>
                            <input type="submit" value="Lưu">
                        </div>

                </div>
                <div>

                    @if($user->image !==null)
                        <img src="{{$user->image}}" class="preview preview-img" id="preview">
                    @else
                        <img src="{{asset('images/user.png')}}" class="preview preview-img" id="preview">
                    @endif
                    <input  name="anh_nd" type="file" class="input" />

                </div>
            </div>
    </form>
        </div>

{{--    <script>--}}
{{--        // const src  = document.querySelector('.preview')--}}
{{--        // const ipnFileElement = document.querySelector('.input')--}}
{{--        // const resultElement = document.querySelector('.preview')--}}
{{--        // const validImageTypes = ['image/gif', 'image/jpeg', 'image/png']--}}
{{--        //--}}
{{--        // ipnFileElement.addEventListener('change', function(e) {--}}
{{--        //     const files = e.target.files--}}
{{--        //     const file = files[0]--}}
{{--        //     const fileType = file['type']--}}
{{--        //--}}
{{--        //     if (!validImageTypes.includes(fileType)) {--}}
{{--        //         resultElement.insertAdjacentHTML(--}}
{{--        //             'beforeend',--}}
{{--        //             '<span class="preview-img">Chọn ảnh đi :3</span>'--}}
{{--        //         )--}}
{{--        //         return--}}
{{--        //     }--}}
{{--        //--}}
{{--        //     const fileReader = new FileReader()--}}
{{--        //     fileReader.readAsDataURL(file)--}}
{{--        //--}}
{{--        //     fileReader.onload = function() {--}}
{{--        //         const url = fileReader.result--}}
{{--        //--}}
{{--        //         src.setAttribute("src",url)--}}
{{--        //--}}
{{--        //     }--}}
{{--        // })--}}
{{--    </script>--}}
    <script src="../../script/script.js"></script>
@endsection

