@include('layout.header_shipper')
    <div class="body-home">
        <div class="margin-top"><h2>Hóa đơn đã nhận</h2></div>
       <div class="margin-top">
           @if (session('thongbao'))
               <div class="session-status">
                   {{ session('thongbao') }}
               </div>
           @endif
               @if($hh !==null)
                   <div class="div-xacnhan">
                       <div><p class="chudam text-giua">Thông tin hóa đơn</p></div>
                       <div><p class="chudam text-giua">Số lượng</p></div>
                       <div><p class="chudam text-giua">Đơn giá</p></div>
                       <div><p class="chudam text-giua">Thành tiền</p></div>
                       <div><p class="chudam text-giua">Thông tin người nhận</p></div>
                       <div><p class="chudam text-giua">Thao tác</p></div>
                   </div>
                       <?php  $i=0 ?>
                   @foreach($hh as $value)
                       <div class="bor">
                           <div class="div-xacnhan2">
                               <div>
                                   HD-{{$value[0]->ma_hoadon}}
                                   @foreach($value as $item)
                                       <div class="div-xacnhan3">
                                           <div class="chia_cot_table">
                                               <div>

                                                   @if($item->anh_sp !==null)
                                                       <img class="cart-img" src="{{$item->anh_sp}}">
                                                   @else
                                                       <img class="cart-img" src="{{asset('images/user.png')}}">
                                                   @endif
                                               </div>
                                               <div class="text-giua">
                                                   <a href="{{route('sanpham.show',$item->ma_sp)}}">{{$item->ten_sp}}</a>
                                                   <br>
                                                   <a href="{{route('show_user',$item->ma_nguoidung)}}">shop: {{$item->username}}</a>
                                               </div>
                                           </div>
                                           <div class="text-giua">
                                               {{$item->so_luong_mua}}
                                           </div>
                                           <div class="text-giua">
                                               {{
                                                     number_format(($item->gia_goc - $item->khuyen_mai)*$item->so_luong_mua, 0, '', ',').'đ'
                                                 }}

                                           </div>
                                       </div>
                                   @endforeach
                               </div>
                               <div  class="text-giua">
                                   {{
                                       number_format($tong[$i] + $item->don_gia_vc, 0, '', ',').'đ'
                                       }}


                               </div>
                               <div class="text-giua">
                                   <p>Tên: {{$value[0]->ten_nhan}}</p>
                                   <p>Số điện thoại: {{$value[0]->so_dt_nhan}}</p>
                                   <p>Địa chỉ: {{$value[0]->dia_chi_nhan}}</p>
                               </div>
                               <div class="text-giua">
                                   <button class="button-cart" type="submit" name="submit" ><a href="{{route('shipper-confimresive-order',$value[0]->ma_hoadon)}}">Gửi hàng</a></button>
                                   <button class="button-cart" type="submit" name="submit" ><a href="{{route('trahang',$value[0]->ma_hoadon)}}">Trả hàng</a></button>
                               </div>
                           </div>
                           <div> <p>{{$item->ten_vc}} - {{$item->don_gia_vc}} đ</p></div>
                           <div class="session-status">
                               @if($value[0]->thanhtoan == 0)
                                   <p>Chưa thanh toán</p>
                               @else
                                   <p >Đã thanh toán</p>
                               @endif
                           </div>
                       </div>

                           <?php $i++; ?>
                   @endforeach
               @else
           <h2>Không có hóa đơn nào</h2>
               @endif
       </div>
    </div>
    {{--    <div class="page">{{ $sp->links()}}</div>--}}


