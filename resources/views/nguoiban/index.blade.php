
@extends('layout.header_sell')
@section('sell-home')

    <h2>Thống kê bán hàng</h2>
   <div class="text-giua">
       <a href="{{route('sell-index-all')}}">
           <div class="td-sp">
               <div class="session-status text-lon">
                   {{$count1}}
               </div>
               <div class="gb">
                   <p>Sản phẩm đang bán</p>
               </div>
           </div>
       </a>
       <a href="{{route('sell-index-notduyet')}}">
           <div class="td-sp">
               <div class="session-status text-lon">
                   {{$count2}}
               </div>
               <div class="gb">
                   <p>Sản phẩm chờ duyệt</p>
               </div>
           </div>
       </a>
       <a href="{{route('order_sell_gave')}}">
           <div class="td-sp">
               <div class="session-status text-lon">
                   {{$count3}}
               </div>
               <div class="gb">
                   <p>Hóa đơn đã thanh toán</p>
               </div>
           </div>
       </a>
       <a href="{{route('order_sell_money_away')}}">
           <div class="td-sp">
               <div class="session-status text-lon">
                   {{$count4}}
               </div>
               <div class="gb">
                   <p>Hóa đơn trả hàng</p>
               </div>
           </div>
       </a>
       <a href="#">
           <div class="td-sp">
               <div class="session-status ">
                   {{$tong}} đ
               </div>
               <div class="gb">
                   <p>Doanh thu</p>
               </div>
           </div>
       </a>
   </div>
@endsection
