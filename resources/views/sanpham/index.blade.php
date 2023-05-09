<div>
       @include('layout.header')

    <div class="body-home" align="center">
           <?php $i=0;   foreach ($sp2 as $item ) :{  ?>
        <a href="{{route('sanpham.show',$item->id)}}">
           <div class="td-sp">
             <div>
                 @if($item !==null)
                     <img class="anh_sp" src="{{$item->anh_sp}}">
                 @else
                     <img class="anh_sp" src="{{asset('images/user.png')}}">
                 @endif
             </div>

               <div class="home_a">
                   <a href="{{route('sanpham.show',$item->id)}}"><?php echo $item->ten_sp;?></a>
               </div>
               <div>
                   <p>giá bán: <?php echo $giaban[$i]." "."đ"; }?></p>
               </div>

           </div>
               <?php $i++; endforeach;?>
        </a>
    </div>

</div>
