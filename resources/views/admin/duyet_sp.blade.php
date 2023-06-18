@extends('layout.header_admin')
@section('admin_duyet')
<h2>chi tiết sản phẩm</h2>
<div class="show-lr">

    <div class="khung_sp" >
        @if($sp[0]->anh_sp !==null)
            <img class="ct_anh" src="{{$sp[0]->anh_sp}}">
        @else
            <img class="ct_anh" src="{{asset('images/user.png')}}">
        @endif


        <div class="khung_sp" >
            <?php  $giaban=$sp[0]->gia_goc - $sp[0]->khuyen_mai;?>

            @foreach ($anh as $item)

                @if($item->url !==null)
                    <img class="ct_photos" src="{{$item->url}}">
                @endif
            @endforeach

        </div>

    </div>

    <div>
            <table class="table_show" align="center">
                <tr>
                    <td colspan="3">
                        <h2>
                            {{$sp[0]->ten_sp}}
                        </h2>
                    </td>
                </tr>
                <tr>
                    <th>
                        <p> Thời trang:</p>
                    </th>
                    <td>
                        {{$sp[0]->tenloai}}
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Cửa hàng:</td>
                    <td><a href="{{route('show_user',$nguoidung->id)}}">{{$nguoidung->username}}</a></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        Giá:
                    </td>
                    <td>
                        <p  class="gia_show">
                            {{
                             number_format($sp[0]->gia_goc, 0, '', ',')
                         }} -
                            {{
                                 number_format($sp[0]->khuyen_mai, 0, '', ',')
                             }}
                        </p>

                    </td>

                    <td>
                        <p class="giaban_show">{{
                                 number_format($giaban, 0, '', ',')
                             }} đ</p>
                    </td>
                </tr>

                <tr>
                    <td>Số lượng</td>
                    <td colspan="2">
                        <div class="display_flex">
                            <p>{{$sp[0]->so_luong}} sản phẩm</p>
                        </div>
                    </td>
                </tr>
            </table>
    </div>
</div>
<div class="margin-top float-right">

    @if($sp[0]->trang_thai ===0)
        <button class="btn-sell"><a href="{{route('duyet_confim',$sp[0]->id)}}">Duyệt</a>
    @endif
        <button class="btn-sell"><a href="javascript:window.history.back(-1);">Trở về</a></button>
    </button></div>

@endsection
