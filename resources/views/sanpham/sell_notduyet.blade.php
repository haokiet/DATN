@extends('layout.header_sell_2')
@section('sell-index-notduyet')
    <div>
        <div class="sell_div1">

                <h2>{{count($sp_zero2)}} sản phẩm</h2>

        </div>
        <table class="sell_table">
            <tr>

                <th>tên sản phẩm</th>
                <th>giá gốc</th>
                <th>khuyến mãi</th>
                <th>ngày đăng</th>
                <th>thao tác</th>

            </tr>
        </table>
        <table class="sell_table">
            @foreach($sp_zero as $item)
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

        <div class="page">{{ $sp_zero->links()}}</div>
    </div>
@endsection
