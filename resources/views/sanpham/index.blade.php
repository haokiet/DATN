<div>
       @include('layout.header')

    <link rel="stylesheet" href="../../css/app.css">
    <div class="body-home" align="center">

           <?php $i=0; foreach ($sp as $item ) :{?>
        <a href="{{route('sanpham.show',$item->id)}}">

           <div class="td-sp">
               <img class="anh_sp" src="{{asset('images/'.$item['anh_sp'])}}">
               <br>
               <div class="home_a">
                   <a href="{{route('sanpham.show',$item->id)}}"><?php echo $item->ten_sp;?></a>
               </div>
               <br>
               <p>giá bán: <?php echo $giaban[$i]; }?></p>
           </div>
        </a>
               <?php $i++; endforeach;?>



    </div>

</div>
