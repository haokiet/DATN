@extends('layout.header_sell')
@section('sell-order-delete')
    <div>
        <h2>hoa don bi huy: {{$count}}</h2>
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
                        <a>chi tiết</a>
                    </td>

                </tr>

                    <?php $i++;?>
            @endforeach


        </table>
    </div>
    <div class="page">{{ $sp->links()}}</div>
@endsection
