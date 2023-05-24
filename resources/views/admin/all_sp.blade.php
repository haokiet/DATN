@extends('layout.header_admin')
@section('admin_all')
    <table class="sell_table">
        <tr>
            <td>
                <p class="chudam">Tên sản phẩm</p>
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
                        {{$item->ten_sp}}
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
                            <a href="{{route('duyet_sp',$item->id)}}">Chi tiết</a> | <a href="{{route('delet',$item->id)}}">Xóa</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    <div>

    </div>
@endsection
