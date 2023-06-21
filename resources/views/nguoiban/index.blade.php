
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}

    <div>
        <div class="container">
            <canvas id="myChart"></canvas>
        </div>
        </div>
    </div>

    <?php $i=0; $data =null; $lable=null;?>
    @if($sales != null)
        @foreach($sales as $_sales)
                <?php $lable[$i] = $_sales->year."-".$_sales->month;
                $data[$i] = $_sales->total_amount;
                $i++;
                ?>
        @endforeach
   @if($data !=null | $lable !=null)
       <script>
           let myChart = document.getElementById('myChart').getContext('2d');
           // Global Options
           Chart.defaults.global.defaultFontFamily = 'Lato';
           Chart.defaults.global.defaultFontSize = 18;
           Chart.defaults.global.defaultFontColor = '#777';
           let massPopChart = new Chart(myChart, {
               type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
               data:{
                   labels:[
                       "{{$lable[0]}}"
                   ],
                   datasets:[{
                       label:"{{$lable[0]}}",
                       data:[
                           {{$data[0]}}
                       ],
                       //backgroundColor:'green',
                       backgroundColor:[
                           'rgba(255, 99, 132, 0.6)',
                           'rgba(54, 162, 235, 0.6)',
                           'rgba(255, 206, 86, 0.6)',
                           'rgba(75, 192, 192, 0.6)',
                           'rgba(153, 102, 255, 0.6)',
                           'rgba(255, 159, 64, 0.6)',
                           'rgba(255, 99, 132, 0.6)'
                       ],
                       borderWidth:1,
                       borderColor:'#777',
                       hoverBorderWidth:3,
                       hoverBorderColor:'#000'
                   }]
               },
               options:{
                   title:{
                       display:true,
                       text:'Biểu đồ doanh thu bán hàng',
                       fontSize:25
                   },
                   legend:{
                       display:true,
                       position:'right',
                       labels:{
                           fontColor:'#000'
                       }
                   },
                   layout:{
                       padding:{
                           left:50,
                           right:0,
                           bottom:0,
                           top:0
                       }
                   },
                   tooltips:{
                       enabled:true
                   }
               }
           });
       </script>
   @endif
    @endif
@endsection
