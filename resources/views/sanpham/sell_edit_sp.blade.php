@extends('layout.header_sell')
@section('edit_sp')

    <form action="{{route('update',$sp->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <h2>chỉnh sửa thông tin sản phẩm</h2>
        </div>
        <div class="aaa">
            <?php $user = \Illuminate\Support\Facades\Auth::user() ?>
            <div>
                <ul class="ul-user">
                    <li>Ảnh sản phẩm</li>
                    <li>Tên sản phẩm</li>
                    <li>Thông tin sản phẩm</li>
                    <li>số lượng</li>
                    <li>đơn giá</li>
                    <li>khuyến mãi</li>
                    <li>Ngày khuyến mãi</li>
                    <li>Kết thúc khuyến mãi</li>

                </ul>
            </div>
            <div>
                @csrf
                <ul  class="ul-user">
                    <li>
                        <div class="display_flex">
                            <img src="{{$sp->anh_sp}}" class="preview preview-img2" id="preview">
                            <input type="file" class="input" name="anh_sp" >
                        </div>

                    </li>
                    <li>
                        <input type="text" class="text input-user" required  name="ten_sp" value="{{$sp->ten_sp}}">
                    </li>
                    <li>
                        <textarea name="mo_ta" id="aria">{{$sp->mo_ta}}</textarea>

                    </li>
                    <li>
                        <input type="number" id="so_luong" name="so_luong" min="0" required value="{{$sp->so_luong}}"> rập

                    </li>
                    <li>
                        <input type="number" id="so_luong" name="gia_goc" min="1" required value="{{$sp->gia_goc}}"> vnd
                    </li>
                    <li>
                        <input type="number" id="so_luong" min="0" value="{{$sp->khuyen_mai}}" name="khuyen_mai"> vnd
                    </li>
                    <li>
                        <input type="date" class="input-user2"  value="{{$sp->ngay_km}}"  name="ngay_km">
                    </li>
                    <li>
                        <input type="date" class="input-user2"  value="{{$sp->ket_thuc_km}}"  name="ket_thuc_km">
                    </li>
                </ul>
                <div>
                    <input class="btn-sell" type="submit" value="cập nhật">
                    <button class="btn-sell"><a href="javascript:window.history.back(-1);">Trở về</a></button>
                </div>
            </div>
        </div>
    </form>
    <script src="../../script/script.js"></script>
@endsection
