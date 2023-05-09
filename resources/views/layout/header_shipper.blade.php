
<html>
<link rel="stylesheet" href="../../css/app.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<nav class="nav">
    <div class="header">
        <div class="header-content-1">
            <div>

                    <a href="{{route('logout')}}">logout</a>

            </div>
        </div>
        <div class="header-content-2">
            <div>
                <a href="{{route('shipper-all-order')}}"><h1>Rap may <span style="font-size: 60%">shipper</span></h1></a>
            </div>
            <div class="giohang">
                <a href="{{route('shipper-all-order')}}">Tất cả hóa đơn</a>
            </div>
            <div class="giohang">
                <a href="{{route('shipper-resive-order')}}">Hóa đơn đã nhận</a>
            </div>
        </div>

    </div>

</nav>

</html>
