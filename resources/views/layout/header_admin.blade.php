
<html>
<link rel="stylesheet" href="../../css/app.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<nav class="nav">
    <div class="header">
        <div class="div-search search">
            <a href="{{route('home')}}"> <h1 class="search" >Rap may <span style="font-size: 60%">kênh admin</span></h1> </a>

            <?php $user=\Illuminate\Support\Facades\Auth::user();
            if ($user->image!==null)
            {
                ?><img class="img-header" src="{{asset('images/'.$user->image)}}"> <p class="search"><?php echo $user->username;?></p>
            <?php   }

            else
            {
                ?>

            <img class="img-header" src="{{asset('images/user.png')}}"> <p class="search"><?php echo $user->username;?></p>
            <?php }?>
        </div>

    </div>

</nav>
<div class="sell-main">
    <div class="sell-col scroll-left">
        <ul>
            <li class="li_h">
                <div>
                    <span>Quản lý sản phẩm</span>
                </div>
                <ul>
                    <li class="li_header">
                        <a href="{{route('admin_all')}}">tất cả sản phẩm</a>
                    </li>
                </ul>
            </li>
            <li class="li_h">
                <div>
                    <span>Quản lý người dùng</span>
                </div>
                <ul>
                    <li class="li_header">
                        <a href="{{route('admin_all')}}">tất cả người dùng</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="sell-col scroll-right">
        @yield('admin_duyet')
        @yield('admin_all')

    </div>
</div>

</html>
