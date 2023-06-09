@extends('layout.header_admin')
@section('all_theloai')
    @if(session('thongbao'))
        <div class="session-status text-giua">
            {{session('thongbao')}}
        </div>
    @endif
    <div class="div-vanchuyen text-giua">
        <div><h3>Thông tin Thể loại</h3></div>
        <div><h3>Thêm Thể loại</h3></div>
    </div>
    <div class="div-vanchuyen ">
        <div class="bor">
            <div class="content-thanhtoan2">
                <div class="chudam text-giua">Tên loại</div>
                <div class="chudam text-giua">Thao Tác</div>
            </div>
            @foreach($tl as $item)
                <form method="post" action="{{route('updateTL',$item->id)}}">
                    @csrf
                    <div class="content-thanhtoan2">
                        <div class="text-giua">
                            <input class="input-vanchuyen" required  type="text" name="tenloai" value="{{$item->tenloai}}">
                        </div>
                        <div class="text-giua">
                            <button class="corso" title="cập nhật" type="submit"><p class="fa fa-save"></p></button>
                            <button class="corso" title="xóa" type="button"><a href="{{route('xoaTL',$item->id)}}"><p class="fa fa-trash-o"></p></a></button>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
        <div class="bor">
            <form action="{{route('themTL')}}" method="post">
                @csrf
                <div class="div-vanchuyen margin-top">
                    <div class="chudam text-phai">Tên loại:</div>
                    <div>
                        <input type="text" name="tenloai" class="input-vanchuyen" required placeholder="tên loại">
                    </div>
                </div>
                <div class="margin-top text-giua">
                    <button type="submit" class="pading-am btn-sell corso"><p class="fa fa-plus"> Thêm mới</p></button>
                </div>
            </form>
        </div>
    </div>

@endsection
