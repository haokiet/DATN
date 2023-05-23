@extends('layout.header_order')
@section('sell-order-gave')
    <div>
        <h2></h2>
        <h2>san pham da giao: {{$count}}</h2>
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
                        <a>chi tiết</a>
                    </td>

                </tr>

                    <?php $i++;?>
            @endforeach
        </table>
    </div>
    <div class="page">{{ $sp->links()}}</div>
@endsection
