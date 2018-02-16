@extends('layouts.app') @section('header') @endsection @section('content')
<div class="content content-padding">
    <div class="mdl-card u-padding-top-45 u-padding-bottom-45 mdl-shadow--2dp u-full-width u-mbuttom30 u-center">
        <div class="card-title">
            تم أرسال رابط استرجاع كلمة المرور الى البريد الألكتروني
        </div>
        <img src={{ asset( '/images/checked.svg')}} alt="">
        <div class="card-footer">
                <a href="/" class="mdl-button u-mtop16  mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored ">الرجوع</a>
        </div>
       
    </div>
</div>

@endsection