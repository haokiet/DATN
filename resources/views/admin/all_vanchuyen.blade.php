@extends('layout.header_admin')
@section('all_vanchuyen')
    @if(session('thongbao'))
        <div class="session-status text-giua">
            {{session('thongbao')}}
        </div>
    @endif
        <div class="div-vanchuyen text-giua">
            <div><h3>Thông tin vận chuyển</h3></div>
            <div><h3>Thêm Vận chuyển</h3></div>
        </div>
        <div class="div-vanchuyen ">
            <div class="bor">
                <div class="admin_vanchuyen">
                    <div class="chudam text-giua">Tên vận chuyển</div>
                    <div class="chudam text-giua">Đơn giá vận chuyển</div>
                    <div class="chudam text-giua">Thao Tác</div>
                </div>
                @foreach($vc as $item)
                    <form method="post" action="{{route('updateVC',$item->id)}}">
                        @csrf
                        <div class="admin_vanchuyen margin-top">
                            <div class="text-giua">
                                <input class="input-vanchuyen" required  type="text" name="ten_vc" value="{{$item->ten_vc}}">
                            </div>
                            <div class="text-giua">
                                <input  class="input-vanchuyen" required type="number" min="5000" name="don_gia_vc" value="{{$item->don_gia_vc}}">
                            </div>
                            <div class="text-giua">
                                <input type="submit" value="Cập nhật">
                                <button type="button"><a href="{{route('xoaVC',$item->id)}}">Xóa</a></button>
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>
            <div class="bor">
                <form action="{{route('themVC')}}" method="post">
                    @csrf
                    <div class="div-vanchuyen margin-top">
                        <div class="chudam text-phai">Tên vận chuyển:</div>
                        <div>
                            <input type="text" name="ten_vc" required placeholder="tên vận chuyển">
                        </div>
                    </div>
                    <div class="div-vanchuyen margin-top">
                        <div class="chudam text-phai ">Đơn giá vận chuyển:</div>
                        <div>
                            <input type="number" min="5000" name="don_gia_vc" value="5000" required placeholder="đơn giá vận chuyển">vnd
                        </div>
                    </div>
                    <div class="margin-top text-giua">
                        <input type="submit" class="pading-am btn-sell" value="Thêm">
                    </div>
                </form>
            </div>
        </div>

@endsection
