<h2>{{$title}}</h2>
<p>{{ $date }}</p>

<div class="grid-70-30">
    <div>
        <div class="text-giua chudam div-giaohang">

            <div>Sản phẩm</div>
            <div>Số lượng</div>
            <div>Đơn giá</div>

        </div>
    </div>
    <div class="chudam text-giua">
        <div>Thông tin nhận hàng</div>
    </div>
</div>
<div class="grid-70-30 margin-top">
    <div>
        @foreach($ct_hd as $_ct_hd)
            <div class="div-giaohang">
                <div class="display_flex">
                    <img class="cart-img" src="{{$_ct_hd->anh_sp}}">
                    <p class="text-giua">{{$_ct_hd->ten_sp}}</p>
                </div>
                <div class="text-giua">
                    <p>{{$_ct_hd->so_luong_mua}}</p>
                </div>
                <div class="text-giua">
                    <p>
                        {{
                           number_format(($_ct_hd->gia_goc - $_ct_hd->khuyen_mai) * $_ct_hd->so_luong_mua, 0, '', ',').'đ'
                         }}
                    </p>
                </div>
            </div>

        @endforeach
    </div>
    <div>
        <table class="width-100" align="center">
            <tr>
                <td>Tên nhận:</td>
                <td >{{$ct_hd[0]->ten_nhan}}</td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td >{{$ct_hd[0]->so_dt_nhan}}</td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td >{{$ct_hd[0]->dia_chi_nhan}}</td>
            </tr>
        </table>
    </div>
</div>
<div class="grid-70-30">
    <div>
        <p>{{$_ct_hd->ten_vc}}: {{
                              number_format($_ct_hd->don_gia_vc, 0, '', ',').'đ'
                            }}</p>
    </div>
</div>
