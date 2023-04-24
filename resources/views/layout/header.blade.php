
<html>
<link rel="stylesheet" href="../../css/app.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<nav class="nav">
   <div class="header">
       <div class="header-content-1">
           <div>
               <a href="{{route('sell_home')}}">trở thành người bán</a>
           </div>
           <div>
               @if(\Illuminate\Support\Facades\Auth::check())
                       <a href="{{route('logout')}}">logout</a>
               @else
                       <a href="{{route('login')}}">đăng nhập</a>|
                       <a href="{{route('nguoidung.create')}}">đăng ký</a>
               @endif
           </div>
       </div>
       <div class="header-content-2">
           <div>
               <a href="{{route('home')}}"> <h1>Rap may</h1></a>
           </div>
           <div>
               <input class="s1" type="text" placeholder="tim kiem">
               <button type="button" class="icon-search"><i class="fa fa-search"></i></button>
           </div>
           <div class="giohang">
               <a href="{{route('index_giohang')}}">gio hang</a>| <a href="{{route('buy_show-wait')}}">hóa đơn</a>
           </div>
       </div>

   </div>

</nav>

</html>
