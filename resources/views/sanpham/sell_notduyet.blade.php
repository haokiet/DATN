@extends('layout.header_sell_2')
@section('sell-index-notduyet')
    <div>
        <div class="sell_div1">

                <h2>{{count($sp_zero2)}} sản phẩm</h2>
            <div class="width-50"><a class="chudam" href="{{route('sell_create_sp')}}"><button class="border-none float-right corso"><p class="fa fa-plus"></p> Thêm mới</button></a></div>
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
            @foreach($sp_zero as $item)
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

        <div class="page">{{ $sp_zero->links()}}</div>
    </div>
@endsection
