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
                    <li class="bottom-tt">Ảnh sản phẩm</li>
                    <li >Tên sản phẩm</li>
                    <li>Thông tin sản phẩm</li>
                    <li>Số lượng</li>
                    <li>Đơn giá</li>
                    <li>Loại sản phẩm</li>
                </ul>
            </div>
            <div>
                    @csrf
                    <ul  class="ul-user">
                       <div class="display_flex bottom-tt">
                           <li>
                               <div class="display_flex">
                                   <label class="corso" for="anh_sp"><img src="" class="preview preview-img2" id="preview"></label>
                                   <input accept=".jpg, .png" hidden type="file" class="input" name="anh_sp" id="anh_sp" >
                               </div>
                           </li>
                           <li>
                               <div class="display_flex" align="left">
                                   <input accept=".jpg, .png" type="file" id="files" name="url[]" max="3" multiple />
                               </div>

                           </li>
                       </div>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    if(filesLength >3)
                    {
                        window.alert('không được thêm quá 3 ảnh chi tiết')
                        $("#files").val(null);
                    }
                    else
                    {
                        for (var i = 0; i < filesLength; i++) {
                            var f = files[i]
                            var fileReader = new FileReader();
                            fileReader.onload = (function(e) {
                                var file = e.target;
                                $("<span class=\"pip\">" +
                                    "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                                    "<br/><span class=\"remove\">xóa ảnh</span>" +
                                    "</span>").insertAfter("#files");
                                $(".remove").click(function(){
                                    $(this).parent(".pip").remove();

                                });

                            });
                            fileReader.readAsDataURL(f);
                        }
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
    </script>
    @endsection
