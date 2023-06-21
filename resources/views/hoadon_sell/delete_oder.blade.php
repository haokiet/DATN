@extends('layout.header_order')
@section('sell-order-delete')
    <div>
        <h2>Hóa ơn bị hủy: {{$count}}</h2>
        <table class="sell_table">
            <tr>

                <td><p class="chudam">Tên sản phẩm</p></td>
                <td><p class="chudam">Tổng đơn hàng</p></td>
                <td><p class="chudam">Thao tác</p></td>

            </tr>
        </table>
        <table class="sell_table">
            <?php $i=0;?>
            @foreach($sp as $item)


                <tr>

                    <td>
                        {{$item->ten_sp}}
                    </td>
                    <td>
                        {{$num[$i]}}
                    </td>
                    <td>

                        <a title="xem chi tiết" href="{{route('show-all',$item->id)}}"><p class='fa fa-eye'> Chi tiết</p></a>
                    </td>

                </tr>

                    <?php $i++;?>
            @endforeach


        </table>
    </div>
    <div class="page">{{ $sp->links()}}</div>
@endsection
