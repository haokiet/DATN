@extends('layout.header_admin')
@section('admin_all')
    <h2>Tất cả sản phẩm</h2>
    <table class="sell_table">
        <tr>
            <td>
                <p class="chudam">Sản phẩm</p>
            </td>
            <td>
                <p class="chudam">Giá gốc</p>
            </td>
            <td>
                <p class="chudam">Số lượng</p>
            </td>
            <td>
                <p class="chudam">Ngày đăng</p>
            </td>
            <td>
                <p class="chudam">Thao tác</p>
            </td>
        </tr>
            @foreach($sp as $item)
                <tr>
                    <td>
                        <div class="display_flex">
                            <img class="cart-img" src="{{$item->anh_sp}}">
                            {{$item->ten_sp}}
                        </div>

                    </td>
                    <td>
                        {{$item->gia_goc}}
                    </td>
                    <td>
                        {{$item->so_luong}}
                    </td>
                    <td>
                        {{$item->created_at}}
                    </td>
                    <td>
                        @if($item->trang_thai ===0)
                            <a href="{{route('duyet_sp',$item->id)}}">Duyệt</a> | <a href="{{route('delet',$item->id)}}">Xóa</a>
                        @else
                            <a title="chi tiết" href="{{route('duyet_sp',$item->id)}}"><p class="fa fa-eye"></p></a> | <a title="xóa" href="{{route('delet',$item->id)}}"><p class="fa fa-trash-o"></p></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    <div>

    </div>
@endsection
