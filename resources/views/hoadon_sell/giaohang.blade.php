@extends('layout.header_order')
@section('giaohang')

@if(session('thongbao'))

    <div class="session-status">
        {{session('thongbao')}}
    </div>
@endif
  @if($hd !==null)
      <h2>Giao Hàng: {{count($hd)}} hóa đơn</h2>
      <div class="giaohang text-giua bottom-tt">
          <div class="chudam">Mã Hóa đơn</div>

          <div class="chudam">Đơn giá</div>
          <div class="chudam">Thông tin nhận hàng</div>
          <div class="chudam">Thao tác</div>
      </div>

      @foreach($hd as $_hd)
              <?php $tong = 0; ?>
          <div>

          <div class="giaohang text-giua margin-top bottom-tt border-bottom">
              @foreach($ct_hd as $_cthd)
                  @if($_cthd->ma_hoadon == $_hd)
                          <?php
                          $tong = $tong + (($_cthd->gia_goc - $_cthd->khuyen_mai)* $_cthd->so_luong_mua + $_cthd->don_gia_vc);
                          $ten_nhan =$_cthd->ten_nhan;
                          $diachi = $_cthd->dia_chi_nhan;
                          $sdt  = $_cthd->so_dt_nhan;

                          ?>
                  @endif
              @endforeach
              <div>HD-{{$_hd}}</div>
              <div>{{number_format($tong, 0, '', ',')."đ" }}</div>
              <div>
                  <table align="center" class="width-100">
                      <tr>
                          <td>Tên Nhận:</td>
                          <td>{{$ten_nhan}}</td>
                      </tr>
                      <tr>
                          <td>Số điện thoại:</td>
                          <td>{{$sdt}}</td>
                      </tr>
                      <tr>
                          <td>Địa chỉ:</td>
                          <td>{{$diachi}}</td>
                      </tr>
                  </table>
              </div>
              <div>
                  <a href="{{route('detail-giaohang',$_hd)}}" class="corso"><button class="btn-sell corso">Giao hàng</button></a>
              </div>
          </div>

              <div class="text-giua session-status">

{{--                  @if($_hd->thanhtoan == 0)--}}
{{--                      <p>Chưa thanh toán</p>--}}
{{--                  @else--}}
{{--                      <p >Đã thanh toán</p>--}}
{{--                  @endif--}}
              </div>
          </div>
      @endforeach

  @else
      <h2 class="text-giua">Không có hóa đơn nào</h2>
  @endif
@endsection
