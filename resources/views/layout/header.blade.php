
<html>
<link rel="stylesheet" href="../../css/app.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<nav class="nav">
   <div class="header">
       <div>
           <ul class="ul-header1">
               <li>
                   <a href="{{route('sell_home')}}">trở thành người bán</a>
               </li>
                   <li class="right">
                       <a href="{{route('login')}}">đăng nhập</a>
                   </li>
                   <li class="right">
                       <a href="{{route('nguoidung.create')}}">đăng ký</a>
                   </li>
               <li class="right">
                   <a href="{{route('logout')}}">logout</a>
               </li>
           </ul>
       </div>
       <div class="div-search">
          <a href="{{route('home')}}"> <h1 class="search" >Rap may</h1></a>
           <input class="search s1" type="text" placeholder="tim kiem">
           <button class="search icon"><i class="fa fa-search"></i></button>
       </div>

   </div>

</nav>

</html>
