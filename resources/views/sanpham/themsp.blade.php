@extends('layout.header_sell')
@section('them_sp')
@if(session('thongbao'))
    <div class="text-giua session-status">
        {{session('thongbao')}}
    </div>
@endif
    <form action="{{route('store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <div>
            <h2>Thêm sản phẩm</h2>
        </div>
        <div class="aaa">
            <?php $user = \Illuminate\Support\Facades\Auth::user() ?>
            <div>
                <ul class="ul-user">
                    <li>Ảnh sản phẩm</li>
                    <li>Ảnh chi tiết</li>
                    <li>Tên sản phẩm</li>
                    <li>Thông tin sản phẩm</li>
                    <li>Số lượng</li>
                    <li>Đơn giá</li>
                    <li>Loại sản phẩm</li>
                </ul>
            </div>
            <div>
                    @csrf
                    <ul  class="ul-user">
                        <li>
                            <div class="display_flex">
                                <img src="" class="preview preview-img2" id="preview">
                                <input type="file" class="input" name="anh_sp" >
                            </div>
                        </li>
                        <li>
                            <input type="file" class="file" name="url[]" multiple="multiple">
                        </li>
                        <li>
                            <input type="text" class="text input-user" REQUIRED name="ten_sp">
                        </li>
                        <li>
                            <textarea name="mo_ta" id="aria"></textarea>

                        </li>
                        <li>
                            <input type="number" id="so_luong" min="1" name="so_luong" required> rập

                        </li>
                        <li>
                            <input type="number" id="so_luong" min="0" name="gia_goc" required> vnd
                        </li>
                        <li>
                            <select id="so_luong" name="theloai"  required>
                                @foreach ($theloai as $item)
                                    <option  value="{{ $item->id }}">{{ $item->tenloai }}</option>
                                @endforeach
                            </select>
                        </li>
                        </ul>
                        <div>
                            <input class="btn-sell" type="submit" value="thêm sản phẩm">
                            <button class="btn-sell"><a href="javascript:window.history.back(-1);">Trở về</a></button>
                        </div>
                </div>
            </div>
        </form>
    <script src="../../script/script.js"></script>
    @endsection
