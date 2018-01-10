@extends('layouts.app') @section('header') @endsection @section('content')
<div class="content content-padding">
    <div class="mdl-card u-padding-top-45 u-padding-bottom-45 mdl-shadow--2dp u-full-width u-mbuttom30 u-center">
        <div class="card-title">
            تم إضافة الإعلان بنجاح
        </div>
        <img src={{ asset( '/images/checked.svg')}} alt="">
        <div class="card-footer">
                <a href="/properties/show/{{$property->id}}" class="mdl-button u-mtop16  mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored ">إذهب للأعلان</a>
        </div>
       
    </div>
</div>

@endsection