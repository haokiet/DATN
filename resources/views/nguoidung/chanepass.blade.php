@extends('layout.header_profile')
@section('chanpass')
    <?php $user = \Illuminate\Support\Facades\Auth::user();
$check = 0;
    if (isset($_GET['submit']))
    {
        $u =  $_GET['ero'];
        $p = $_GET['pass'];
//       $v=bcrypt('123456');
//       dd($v);
         $isVa = password_verify($p, $user->password);
         if ($isVa ==true)
         {
             $check = 1;
         }
         else
         {
             $check = 2;
             $u = 'Mật khẩu không đúng';
         }


    }
?>

    <div>

        <h3>Thay đổi mật khẩu</h3>
    </div>

        <div class="div-content-user">
            <div>
                <ul class="ul-user">

                    @if($check !==1)
                        <li></li>
                    <li>Mật khẩu hiện tại</li>
                    @endif
                    <li></li>
                    @if($check ==1)
                        <li>Mật khẩu mới</li>
                        <li>Nhập lại mật khẩu</li>
                    @endif
                </ul>
            </div>
            <div>

                @csrf
                <ul  class="ul-user">
                    <form method="get">

                        <li><input name="ero" class="check session-status input-user" type="text" value="<?php if (isset($u) & $check ===2 ){ echo $u;} if(session('thongbao')){
                             echo session('thongbao');
                           } ?>">
                        </li>
                    @if($check !==1)
                            <li>
                                <input name="pass" class="input-user" type="password" required value="">
                            </li>
                            <li><input type="submit" name="submit"></li>
                        @endif
                     </form >
                    @if($check ==1)
                    <form method="post" action="{{route('chanePass')}}">
                        @csrf
                    <li>
                        <input class="input-user" type="password" minlength="6"  name="newpass" value="" required>
                    </li>
                    <li>
                        <input name="renewpass" class="input-user" minlength="6" type="password" value="">
                    </li>
                            <li><input type="submit" value="Đổi mật khẩu"></li>
                    </form>
                    @endif
                </ul>

            </div>
            <div>

                @if($user->image !==null)
                    <img src="{{$user->image}}" class="preview preview-img" id="preview">
                @else
                    <img src="{{asset('images/user.png')}}" class="preview preview-img" id="preview">
                @endif
            </div>
        </div>
    </div>
    <script>

    </script>
@endsection

