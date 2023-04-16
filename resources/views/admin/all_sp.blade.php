@extends('layout.header_admin')
@section('admin_all')
    <table class="sell_table">
        <tr>
            <td>
                <p>tên sản phẩm</p>
            </td>
            <td>
                <p>giá gốc</p>
            </td>
            <td>
                <p>số lượng</p>
            </td>
            <td>
                <p>ngày đăng</p>
            </td>
            <td>
                <p>thao tác</p>
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
                        <a href="{{route('duyet_sp',$item->id)}}">duyệt</a> | <a href="{{route('delet',$item->id)}}">xóa</a>
                    </td>
                </tr>
            @endforeach
        </table>
    <div>

    </div>
@endsection
