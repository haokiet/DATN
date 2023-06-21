@extends('layout.header_admin')
@section('admin_all')
    <h2>Tất cả sản phẩm</h2>
    @if(session('thongbao'))
        <div class="session-status">
            {{session('thongbao')}}
        </div>
    @endif
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

                        {{
                             number_format($item->gia_goc, 0, '', ',')
                        }} vnd
                    </td>
                    <td>
                        {{$item->so_luong}}
                    </td>
                    <td>
                        {{$item->created_at}}
                    </td>
                    <td>
                        @if($item->trang_thai ===0)
                            <a href="{{route('duyet_sp',$item->id)}}"><button class="corso">Duyệt</button></a> | <a href="{{route('vipham',$item->id)}}"><button class="corso">Xóa</button></a>
                        @else
                            <a title="chi tiết" href="{{route('duyet_sp',$item->id)}}"><button class="corso btn"><i class="fa fa-eye"></i></button></a> | <a title="xóa" href="{{route('vipham',$item->id)}}"><button class="corso"><i class="fa fa-trash-o"></i></button></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    <div>

    </div>
@endsection
