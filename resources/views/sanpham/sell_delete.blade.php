@extends('layout.header_sell_2')
@section('sell-index-delete')

    <div>
        <div class="sell_div1">

                <h2>{{count($sp_dele2)}} sản phẩm</h2>
        </div>
        <table class="sell_table">
            <tr>

                <td><p class="chudam">Tên sản phẩm</p></td>
                <td><p class="chudam">Giá gốc</p></td>
                <td><p class="chudam">Khuyến mãi</p></td>
                <td><p class="chudam">Ngày đăng</p></td>
                <td ><p class="chudam">Thao tác</p></td>

            </tr>
        </table>
        <table class="sell_table">
            @foreach($sp_dele as $item)
                <tr>


                    <td>
                        {{$item->ten_sp}}
                    </td>
                    <td>
                        {{$item->gia_goc}}
                    </td>
                    <td>
                        {{$item->khuyen_mai}}
                    </td>
                    <td>
                        {{$item->created_at}}
                    </td>
                    <td>
                        <a href="{{route('edit_sell_sp',$item->id)}}">sửa</a> | <a href="{{route('delet',$item->id)}}">xóa</a>
                    </td>

                </tr>
            @endforeach
        </table>
        <div class="page">{{ $sp_dele->links()}}</div>

    </div>
@endsection
