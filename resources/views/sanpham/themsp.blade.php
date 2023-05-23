@extends('layout.header_sell')
@section('them_sp')

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
                    <li>số lượng</li>
                    <li>đơn giá</li>
                    <li>loại sản phẩm</li>
                </ul>
            </div>
            <div>
                    @csrf
                    <ul  class="ul-user">
                        <li>
                            <input required type="file" class="file" name="anh_sp">
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
                            <input type="number" id="so_luong" name="so_luong" required> rập

                        </li>
                        <li>
                            <input type="number" id="so_luong" name="gia_goc" required> vnd
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
                            <input type="submit" value="thêm sản phẩm">
                        </div>
                </div>
            </div>
        </form>
    @endsection
