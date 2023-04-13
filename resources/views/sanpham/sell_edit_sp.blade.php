@extends('layout.header_sell')
@section('edit_sp')

    <form action="{{route('update',$sp->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <h2>chỉnh sửa thông tin sản phẩm</h2>
        </div>
            <div class="creat_sp">
                <ul>
                    <li class="create_left">
                        <p>tên sản phẩm sản phẩm</p>
                    </li>
                    <li class="create_right">
                        <input type="text" class="text" value="{{$sp->ten_sp}}" name="ten_sp">
                    </li>
                </ul>
            </div>
            <div class="creat_sp">
                <ul>
                    <li class="create_left">
                        <p>thông tin sản phẩm</p>
                    </li>
                    <li class="create_right">
                        <textarea name="mo_ta"  class="aria">{{$sp->mo_ta}}</textarea>
                    </li>
                </ul>
            </div>
            <div class="creat_sp">
                <ul>
                    <li class="create_left">
                        <p>số lượng</p>
                    </li>
                    <li class="create_right">
                        <input type="number" value="{{$sp->so_luong}}" class="num" name="so_luong">
                    </li>
                </ul>
            </div>
            <div class="creat_sp">
                <ul>
                    <li class="create_left">
                        <p>đơn giá</p>
                    </li>
                    <li class="create_right">
                        <input type="number" class="num" value="{{$sp->gia_goc}}" name="gia_goc">
                    </li>
                </ul>
            </div>
        <div class="creat_sp">
            <ul>
                <li class="create_left">
                    <p>khuyến mãi</p>
                </li>
                <li class="create_right">
                    <input type="number" value="{{$sp->khuyen_mai}}" class="num" name="khuyen_mai">
                </li>
            </ul>
        </div>
        <div class="creat_sp">
            <ul>
                <li class="create_left">
                    <p>số lượng</p>
                </li>
                <li class="create_right">
                    <input type="date"  value="{{$sp->ngay_km}}" class="num" name="ngay_km">
                </li>
            </ul>
        </div>
        <div class="creat_sp">
            <ul>
                <li class="create_left">
                    <p>kết thúc khuyến mãi</p>
                </li>
                <li class="create_right">
                    <input type="date"  value="{{$sp->ket_thuc_km}}" class="num" name="ket_thuc_km">
                </li>
            </ul>
        </div>

            <div class="creat_sp">
                <ul>
                    <li class="create_left">
                        <input type="submit" value="xác nhận">
                    </li>
                    <li class="create_right">
                        <a href="javascript:window.history.back(-1);">Trở về</a>
                    </li>
                </ul>
            </div>
        </div>
    </form>
@endsection
