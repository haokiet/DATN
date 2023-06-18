
<html>
<link rel="stylesheet" href="../../css/app.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<nav class="nav">
   <div class="header">
       <div class="header-content-1">
           <div>
               <a href="{{route('sell_home')}}">Trở thành người bán</a>
           </div>
           <div class="border-radius-10">
               @if(\Illuminate\Support\Facades\Auth::check())
                       <?php $user=\Illuminate\Support\Facades\Auth::user();?>


                   <div class="dropdown">
                       @if ($user->image!==null)
                       <a  href="{{route('profile_user')}}"><img class="img-header2" src="{{$user->image}}">{{$user->username}}</a>
                       @else
                           <a class="dropbtn" href="{{route('profile_user')}}"><img class="img-header2" src="{{asset('images/user.png')}}">{{$user->username}}</a>
                       @endif
                       <div class="dropdown-content">
                           <a href="{{route('logout')}}">Đăng xuất</a>
                           <a href="{{route('profile_user')}}">Hồ sơ</a>
                           <a href="{{route('buy_show-wait')}}">Hóa đơn</a>
                       </div>
                   </div>

               @else
                       <a href="{{route('login')}}">Đăng nhập</a>|
                       <a href="{{route('nguoidung.create')}}">Đăng ký</a>
               @endif
           </div>
       </div>
       <div class="header-content-2">
           <div>
               <a href="{{route('home')}}"> <h1>Rập may</h1></a>
           </div>

           <div id="search">
               <form method="get" action="{{route('timkiem')}}">
                   @csrf
                   <input class="s1" type="text" name="value" placeholder="tim kiem">

                   <button type="button" class="icon-search"><i class="fa fa-search"></i></button>
               </form>

           </div>



           <div class="giohang">
               <a href="{{route('index_giohang')}}"><i class="icon-cart fa fa-shopping-cart"></i></a>
           </div>
       </div>

   </div>

</nav>
@yield('header_profile_user')
</html>
