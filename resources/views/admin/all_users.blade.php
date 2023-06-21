@extends('layout.header_admin')
@section('admin_all_user')
    <h2>Tất cả người dùng</h2>
    @if(session('thongbao'))
        <div class="session-status">
            {{session('thongbao')}}
        </div>
    @endif
    <table class="sell_table">
        <tr>

            <td>
                <p class="chudam">Tên người dùng</p>
            </td>
            <td>
                <p class="chudam">Email</p>
            </td>
            <td>
                <p class="chudam">Giới tính </p>
            </td>
            <td>
                <p class="chudam">Phân loại</p>
            </td>
            <td>
                <p class="chudam">Thao tác</p>
            </td>
        </tr>
        @foreach($users as $item)
            <tr>

                <td>
                    {{$item->username}}
                </td>
                <td>
                    {{$item->email}}
                </td>
                <td>
                   @if($item->gioi_tinh ===0)
                       Nam
                    @elseif($item->gioi_tinh ===1)
                    Nữ
                    @else
                       Không xác định
                    @endif
                </td>
                <td>
                    @if($item->role ===0)
                        Nomal
                    @elseif($item->role ===1)
                    Shipper
                    @else
                    Admin
                    @endif
                </td>
                <td>
                   <a title="chi tiết" href="{{route('chiTiet_user',$item->id)}}"> <button class="btn-sell corso"><p class="fa fa-eye" aria-hidden="true"></p></button></a>
                </td>
            </tr>
        @endforeach
    </table>
       {{$users->links()}}
@endsection
