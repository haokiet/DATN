<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Hóa đơn</title>
    <link rel="stylesheet" href="../../css/app.css">
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <style>
        body{
            font-family: serif;

        }
        .pdfleft{
            width: 50%;
            float: left;
            text-align: center;
        }
        .pdfright
        {
            width: 50%;
            float: right;
            text-align: center;
        }
        table{
            width: 100%;
            text-align: center;
        }
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<h2>Cam on ban da tham gia san giao dich Rapmay</h2>
<h2>HD-{{$idhd}}</h2>
<h3>Shop: {{$user->username}}</h3>
<?php $tong =0; ?>
<div class="pdfleft">
    <table align="center">
        <tr>
            <td>
                <p>San Pham</p>
            </td>
            <td>
                <p>So luong</p>
            </td>
            <td>
                <p>Don gia</p>
            </td>
        </tr>
        @foreach($ct_hd as $_ct_hd)
            <tr>
                <td>
                    {{$_ct_hd->ten_sp}}

                </td>
                <td>
                    {{$_ct_hd->so_luong_mua}}
                </td>
                <td>
                    {{
                           number_format(($_ct_hd->gia_goc - $_ct_hd->khuyen_mai) * $_ct_hd->so_luong_mua, 0, '', ',').'VND'
                         }}

                            <?php $tong = $tong + (($_ct_hd->gia_goc - $_ct_hd->khuyen_mai) * $_ct_hd->so_luong_mua) ?>
                </td>
            </tr>
        @endforeach
    </table>
</div>
<div class="pdfright">
    <div>
        <?php $tong = $tong + $ct_hd[0]->don_gia_vc ?>
        <table align="center">
            <tr>
                <td>Nguoi nhan:</td>
                <td >
                   {{$ct_hd[0]->ten_nhan}}
                    </td>
            </tr>
            <tr>
                <td>So dien thoai:</td>
                <td >
                   {{$ct_hd[0]->so_dt_nhan}}
                </td>
            </tr>
            <tr>
                <td>Dia chi:</td>
                <td >
                   {{$ct_hd[0]->dia_chi_nhan}}
                </td>
            </tr>
        </table>
    </div>
    <div>
       {{$ct_hd[0]->ten_vc}}:
       {{
                              number_format($ct_hd[0]->don_gia_vc, 0, '', ',').'VND'
                            }}
    </div>

    <div>
        <h3>Tong Tien: {{
                              number_format($tong, 0, '', ',').'VND'
                            }}</h3>
    </div>
</div>

{{--<div class="width-100">--}}
{{--    <div class="grid-70-30">--}}
{{--        <div>--}}
{{--            <div class="text-giua chudam div-giaohang">--}}

{{--                <div>Sản phẩm</div>--}}
{{--                <div>Số lượng</div>--}}
{{--                <div>Đơn giá</div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="chudam text-giua">--}}
{{--            <div>Thông tin nhận hàng</div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="grid-70-30 margin-top">--}}
{{--        <div>--}}
{{--            @foreach($ct_hd as $_ct_hd)--}}
{{--                <div class="div-giaohang">--}}
{{--                    <div class="display_flex">--}}
{{--                        <p class="text-giua">{{$_ct_hd->ten_sp}}</p>--}}
{{--                    </div>--}}
{{--                    <div class="text-giua">--}}
{{--                        <p>{{$_ct_hd->so_luong_mua}}</p>--}}
{{--                    </div>--}}
{{--                    <div class="text-giua">--}}
{{--                        <p>--}}
{{--                                <?php $tong = $tong + (($_ct_hd->gia_goc - $_ct_hd->khuyen_mai) * $_ct_hd->so_luong_mua) ?>--}}
{{--                            {{--}}
{{--                               number_format(($_ct_hd->gia_goc - $_ct_hd->khuyen_mai) * $_ct_hd->so_luong_mua, 0, '', ',').'đ'--}}
{{--                             }}--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            @endforeach--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <?php $tong = $tong + $ct_hd[0]->don_gia_vc ?>--}}
{{--            <table class="width-100" align="center">--}}
{{--                <tr>--}}
{{--                    <td>Tên nhận:</td>--}}
{{--                    <td >{{$ct_hd[0]->ten_nhan}}</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>Số điện thoại:</td>--}}
{{--                    <td >{{$ct_hd[0]->so_dt_nhan}}</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>Địa chỉ:</td>--}}
{{--                    <td >{{$ct_hd[0]->dia_chi_nhan}}</td>--}}
{{--                </tr>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="grid-60-40">--}}
{{--        <div>--}}
{{--            <p>{{$ct_hd[0]->ten_vc}}: {{--}}
{{--                              number_format($ct_hd[0]->don_gia_vc, 0, '', ',').'đ'--}}
{{--                            }}</p>--}}
{{--        </div>--}}

{{--        <div class="display_flex margin-top">--}}
{{--            <h3>Tổng tiền: {{--}}
{{--                              number_format($tong, 0, '', ',').'đ'--}}
{{--                            }}</h3>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--</div>--}}
</body>
</html>
<script>
    // function convert_vi_to_en(str) {
    //     str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    //     str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    //     str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    //     str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    //     str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    //     str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    //     str = str.replace(/đ/g, "d");
    //     str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    //     str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    //     str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    //     str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    //     str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    //     str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    //     str = str.replace(/Đ/g, "D");
    //     str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g, " ");
    //     str = str.replace(/  +/g, ' ');
    //     return str;
    // }
    // $(document).on('keyup', '[id=ten_sp]', function () {
    //     var obj = $(this);
    //     $('#ten_sp').val(convert_vi_to_en(obj.val()).toLowerCase().replace(/ /g, "-"));
    // });
    // $(document).on('keyup', '[id=tong]', function () {
    //     var obj = $(this);
    //     $('#tong').val(convert_vi_to_en(obj.val()).toLowerCase().replace(/ /g, "-"));
    // });
    // $(document).on('keyup', '[id=nguoi_nhan]', function () {
    //     var obj = $(this);
    //     $('#nguoi_nhan').val(convert_vi_to_en(obj.val()).toLowerCase().replace(/ /g, "-"));
    // });
    // $(document).on('keyup', '[id=dia_chi]', function () {
    //     var obj = $(this);
    //     $('#dia_chi').val(convert_vi_to_en(obj.val()).toLowerCase().replace(/ /g, "-"));
    // });
    // $(document).on('keyup', '[id=vanchuyen]', function () {
    //     var obj = $(this);
    //     $('#vanchuyen').val(convert_vi_to_en(obj.val()).toLowerCase().replace(/ /g, "-"));
    // });
    // $(document).on('keyup', '[id=tong_tien]', function () {
    //     var obj = $(this);
    //     $('#tong-tien').val(convert_vi_to_en(obj.val()).toLowerCase().replace(/ /g, "-"));
    // });
</script>






