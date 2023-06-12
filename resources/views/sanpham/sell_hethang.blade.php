@extends('layout.header_sell_2')
@section('sell-index-hethang')

    <div>
        <div class="sell_div1">

                <h2>{{count($sp_no2)}} sản phẩm</h2>


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
            @foreach($sp_no as $item)
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
                        {{$item->khuyen_mai}}
                    </td>
                    <td>
                        {{$item->created_at}}
                    </td>
                    <td>
                        <a title="chỉnh sửa" href="{{route('edit_sell_sp',$item->id)}}"><i class='fa fa-edit'></i></a> | <a title="xóa" href="{{route('delet',$item->id)}}"><i class="fa fa-trash-o"></i></a>
                    </td>

                </tr>
            @endforeach
        </table>
        <div class="page">{{ $sp_no->links()}}</div>

    </div>
@endsection
