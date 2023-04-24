@extends('layout.header_order')
@section('sell-order-wait')
    <div>
        <h2></h2>
        <h2>hoa don cho xac nhan: {{$count}}</h2>
        <table class="sell_table">
            <tr>

                <th>tên sản phẩm</th>
                <th>Tổng đơn hàng</th>
                <th>thao tác</th>

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
