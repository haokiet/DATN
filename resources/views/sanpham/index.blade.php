@include('layout.header')

<link rel="stylesheet" href="../../css/app.css">
<div class="body-home" align="center">

        <?php $i=0; foreach ($sp as $item ) :{?>
    <div class="td-sp">
        <img class="anh_sp" src="{{asset('images/'.$item['anh_sp'])}}">
        <br>
        <a href="{{route('sanpham.show',$item->id)}}"><?php echo $item->ten_sp;?></a>
        <br>

        <p>giá bán: <?php echo $giaban[$i]; }?></p>
    </div>
    <?php $i++; endforeach;?>


</div>
