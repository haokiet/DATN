@extends('layout.header_sell')
@section('them_sp')

    <form action="{{route('store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <div>
            <h2>them san pham</h2>
        </div>
        <div>
            <div class="creat_sp">
                <ul>
                    <li class="create_left">
                        <p>ảnh đại diện </p>
                    </li>
                    <li class="create_right">
                        <input type="file" class="file" name="anh_sp">
                    </li>
                </ul>
            </div>
            <div class="creat_sp">
                <ul>
                    <li class="create_left">
                        <p>ảnh chi tiết</p>
                    </li>
                    <li class="create_right">
                        <input type="file" class="file" name="url[]" multiple="multiple">
                    </li>
                </ul>
            </div>
            <div class="creat_sp">
                <ul>
                    <li class="create_left">
                        <p>tên sản phẩm sản phẩm</p>
                    </li>
                    <li class="create_right">
                        <input type="text" class="text" name="ten_sp">
                    </li>
                </ul>
            </div>
            <div class="creat_sp">
                <ul>
                    <li class="create_left">
                        <p>thông tin sản phẩm</p>
                    </li>
                    <li class="create_right">
                        <textarea name="mo_ta" class="aria"></textarea>
                    </li>
                </ul>
            </div>
            <div class="creat_sp">
                <ul>
                    <li class="create_left">
                        <p>số lượng</p>
                    </li>
                    <li class="create_right">
                        <input type="number" class="num" name="so_luong">
                    </li>
                </ul>
            </div>
            <div class="creat_sp">
                <ul>
                    <li class="create_left">
                        <p>đơn giá</p>
                    </li>
                    <li class="create_right">
                        <input type="number" class="num" name="gia_goc">
                    </li>
                </ul>
            </div>
            <div class="creat_sp">
                <ul>
                    <li class="create_left">
                        <p>loại sản phẩm</p>
                    </li>
                    <li class="create_right">
                        <select id="multiple-selected" name="theloai"  class="select_theloai" required>
                            @foreach ($theloai as $item)
                                <option  value="{{ $item->id }}">{{ $item->tenloai }}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>
            </div>
            <div class="creat_sp">
                <ul>
                    <li class="create_left">
                        <input type="submit" value="thêm">
                    </li>
                    <li class="create_right">
                        <a href="javascript:window.history.back(-1);">Trở về</a>
                    </li>
                </ul>
            </div>
        </div>
    </form>
@endsection
