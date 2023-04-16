@extends('layout.header_admin')
@section('admin_duyet')
<h2>chi tiết sản phẩm</h2>
    <table>
        <tr>
            <td>
                tên sp
            </td>
            <td>
                {{$sp->ten_sp}}
            </td>
            <td>
                <a href="{{route('duyet_confim',$sp->id)}}">duyet</a>
            </td>

        </tr>
    </table>
@endsection
