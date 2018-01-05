@extends('layouts.app') @section('header') @endsection @section('content')
<div class="content">
    @include('components.propertySorts')
    <div class="grid">
        <div class="mdl-cell mdl-cell--12-col">
            <div class="card horizontal mdl-card mdl-shadow--2dp h-card">
                <button id="demo-menu-lower-left"
                    class="mdl-button  h-card-actions mdl-js-button mdl-button--icon">
                    <i class="material-icons">settings</i>
            </button>
            
            <ul class="mdl-menu mdl-menu--bottom-left mdl-menu--custom mdl-js-menu mdl-js-ripple-effect"
                for="demo-menu-lower-left">
              <li class="mdl-menu__item"><i class="material-icons md-18">mode_edit</i> <span>تعديل</span> </li>
              <li class="mdl-menu__item mdl-menu__item--full-bleed-divider"> <i class="material-icons md-18">delete</i><span>حذف</span> </li>
            </ul>
                <div class="card-image">
                    <img src={{ asset( 'images/card1.png') }}>
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <h5 class="card--title">فيلا للبيع في حي الراشدية</h5>
                        <h6 class="card--sub-title">الراشدية ,مكة الكرمة</h6>
                        <p class="card--text">ملحق دور ثالث فى عمارة تجارية بدون مصعد كهرباء مشترك عمارة هادئة جدا مكونة من غرفتين صغار</p>
                        <p>
                            <span class="card--text__size"> 405 م
                                <sup>2</sup>
                            </span>
                    </div>
                    <div class="card-footer">
                        <div class="card-footer__price">
                            <span class="price--text">
                                290,000 ريال
                            </span>
                        </div>
                        <div class="footer-contet">
                            <span>4</span>
                            <img src={{ asset( 'images/bathroom.svg')}} alt="">
                            <span>4</span>
                            <i class="material-icons md-18">local_hotel</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection