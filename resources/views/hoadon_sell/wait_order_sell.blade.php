@extends('layout.header_order')
@section('sell-order-wait')
    <div>
        <h2></h2>
        <h2>hoa don cho xac nhan: {{$count}}</h2>
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
                        <a href="{{route('show-wait',$item->id)}}">chi tiết</a>
                    </td>

                </tr>

                    <?php $i++;?>
            @endforeach
        </table>
    </div>
    <div class="page">{{ $sp->links()}}</div>
@endsection
