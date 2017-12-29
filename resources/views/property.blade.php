@extends('layouts.app') @section('header') @endsection @section('content')


<div class="content">
    <div class="page-header">
        <div class="mdl-grid ">
            <div class="mdl-cell mdl-cell--9-col">
                <div class="mdl-color-text--grey-500 page-breadcrumb">
                    شقق للإيجار&gt; الرياض &gt; حى المروج
                </div>
            </div>
            <div class="mdl-cell mdl-cell--3-col mdl-color-text--grey-500">
                <i class="material-icons u-fix-icon-top">access_time</i>
                <span class="page-date"> اخر تحديث فى 26 أكتوبر 2017</span>
            </div>
            <h4 class="page-title mdl-cell mdl-cell--12-col  u-primary-darker-color">شقة للإيجار فى شارع بن الطرائفى</h4>
        </div>

    </div>
    <div class="mdl-grid sticky-container">
        <div class="mdl-cell mdl-cell--9-col">
            <div class="mdl-card  mdl-shadow--2dp u-auto-width u-mbuttom16 gallery-card">
                <div class="gallery-img" id="galleryImg">

                    <iframe src="https://www.youtube.com/embed/rwvmru5JmXk?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" gesture="media"
                        allow="encrypted-media" allowfullscreen></iframe>

                </div>
                <div id="owl-example" class="owl-carousel owl-centered">
                    <div class="item">
                        <div class="owl-click"></div>
                        <iframe class="target" src="https://www.youtube.com/embed/rwvmru5JmXk?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0"
                            gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                    </div>
                    <div class="item">
                        <div class="owl-click"></div>
                        <img class="target" src={{ asset ( 'images/card1.png') }} alt="">
                    </div>
                    <div class="item">
                        <div class="owl-click"></div>
                        <img class="target" src={{ asset ( 'images/card1.png') }} alt="">
                    </div>
                    <div class="item">
                        <div class="owl-click"></div>
                        <img class="target" src={{ asset ( 'images/card1.png') }} alt="">
                    </div>
                    <div class="item">
                        <div class="owl-click"></div>
                        <img class="target" src={{ asset ( 'images/card1.png') }} alt="">
                    </div>
                    <div class="item">
                        <div class="owl-click"></div>
                        <img class="target" src={{ asset ( 'images/card1.png') }} alt="">
                    </div>



                </div>
            </div>
            <div class="mdl-card  mdl-shadow--2dp u-auto-width u-height-auto u-padding-top-45 u-padding-bottom-15 u-mbuttom16 u-padding-side-20">
                <p class="u-padding-top-25 u-headline-color">ملحق دور ثالث فى عمارة تجارية بدون مصعد كهرباء مشترك عمارة هادئة جدا مكونة </p>
                <span class="card-label top-label-right has-primary-base-bg">التفاصيل</span>

            </div>
            <div class="mdl-card  mdl-shadow--2dp u-auto-width u-mbuttom30  u-padding-side-20">
                <table class="mdl-data-table u-full-width u-no-border">
                    <tbody>
                        <tr>
                            <td class="u-no-border-top header">رقم الأعلان</td>
                            <td class="u-no-border-top ">195145</td>
                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">السعر</td>
                            <td class="u-no-border-top">

                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">سعر المتر</td>
                            <td class="u-no-border-top">

                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">تاريخ النشر</td>
                            <td class="u-no-border-top">

                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">النوع</td>
                            <td class="u-no-border-top">

                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">الساحة بالمتر</td>
                            <td class="u-no-border-top">

                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">نوع الملن</td>
                            <td class="u-no-border-top">

                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">الغرف</td>
                            <td class="u-no-border-top">

                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">الطابق</td>
                            <td class="u-no-border-top">

                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">الحمامات</td>
                            <td class="u-no-border-top">

                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">سنة البناء</td>
                            <td class="u-no-border-top">

                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">نوع التشطيب</td>
                            <td class="u-no-border-top">

                            </td>

                        </tr>

                    </tbody>
                </table>

            </div>
            <div class="group-ad">
                <div class="group-ad__header">
                    <h6 class="group-ad__title">عروض اسعار</h6>
                </div>

                <div class="mdl-card mdl-card--pro  mdl-shadow--2dp u-auto-width u-mbuttom16 u-height-auto u-padding-top-45">

                    <div class="title">
                        <div class="mdl-avatar">
                            <img class="" src={{ asset ( 'images/face.png') }} alt="">
                        </div>
                        <h5 class="u-primary-darker-color">سليمان بن عدنان الثقفي</h5>
                    </div>
                    <div class="contet">
                        <p class="u-headline-color">ملحق دور ثالث فى عمارة تجارية بدون مصعد كهرباء مشترك عمارة هادئة جدا مكونة </p>
                    </div>

                    <span class="card-label top-label-left has-secondary-base-bg">عرض السعر 3,180,000 ريال</span>
                </div>
              
              
           
               
             

            </div>
        </div>
        <div class="mdl-cell mdl-cell--3-col sticky-item">
            <div class="mdl-card  mdl-shadow--2dp u-auto-width u-mbuttom16 u-padding-bottom-60 u-relative">
                <table class="mdl-data-table u-full-width u-no-border">
                    <tbody>
                        <tr>
                            <td class="u-no-border-top u-center" width="8%">145م</td>
                            <td class="u-no-border-top" width="2%">
                                <i class="material-icons">space_bar</i>
                            </td>
                            <td class="u-no-border-top  header">المساحة</td>
                        </tr>
                        <tr>
                            <td class="u-no-border-top u-center" width="8%">4</td>
                            <td class="u-no-border-top" width="2%">
                                <i class="material-icons">space_bar</i>
                            </td>
                            <td class="u-no-border-top  header">الغرف</td>
                        </tr>
                        <tr>
                            <td class="u-no-border-top u-center" width="8%">4</td>
                            <td class="u-no-border-top" width="2%">
                                <i class="material-icons">space_bar</i>
                            </td>
                            <td class="u-no-border-top  header">الحمامات</td>
                        </tr>
                    </tbody>
                </table>
                <span class="card-label bottom-label-left has-secondary-base-bg">3,180,000 ريال</span>
            </div>
            <div class="mdl-card  mdl-shadow--2dp u-padding-side-20 u-auto-width u-padding-bottom-15 u-mbuttom16 u-height-auto has-actions">
                <table class="mdl-data-table u-full-width u-no-border u-mbuttom16">
                    <tbody>
                        <tr>
                            <td class="u-no-border-top u-center u-no-padding" width="8%">
                                <div class="mdl-avatar">
                                    <img class="" src={{ asset ( 'images/face.png') }} alt="">
                                </div>

                            </td>
                            <td class="u-no-border-top" width="2%">
                                سليمان بن عدنان الثقفى
                            </td>

                        </tr>
                    </tbody>
                </table>
                <button class="mdl-button  mdl-js-button mdl-js-ripple-effect mdl-button--colored ">
                    <i class="material-icons md-18">call</i>
                    اتصل الأن
                </button>
                <button class="mdl-button  mdl-js-button mdl-js-ripple-effect  mdl-button--borded">
                    <i class="material-icons md-18">chat</i>
                    تواصل مع المعلن
                </button>
            </div>
            <div class="mdl-card  mdl-shadow--2dp  u-padding-top-45 u-auto-width u-mbuttom16  u-padding-side-20 u-padding-bottom-15">
                <form action="#">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="sample25">
                        <label class="mdl-textfield__label" for="sample25">الأسم</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="sample26">
                        <label class="mdl-textfield__label" for="sample26">رقم الجوال</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="sample3">
                        <label class="mdl-textfield__label" for="sample3">السعر</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" type="text" rows="3" id="sample5"></textarea>
                        <label class="mdl-textfield__label" for="sample5">أضف تعليق</label>
                    </div>
                    <button class="mdl-button  mdl-js-button mdl-js-ripple-effect  mdl-button--colored u-full-width">
                        أرسال

                    </button>
                    <span class="card-label top-label-right has-primary-base-bg">قدم عرض سعر</span>
                </form>
            </div>
        </div>
    </div>
    <div class="group-ad">
        <div class="group-ad__header">
            <h6 class="group-ad__title">إعلانات مشابهة</h6>
            <a href="#" class="group-ad__more">المزيد</a>

        </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.vCard')
            </div>
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.vCard')
            </div>
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.vCard')
            </div>
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.vCard')
            </div>
        </div>
    </div>
</div>
@endsection @push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
<script type="text/javascript" src={{ asset( 'js/owl.carousel.rtl.js')}} /></script>
<script>$(".owl-carousel").owlCarouselRtl({
        margin: 0,
        loop: false,
        autoWidth: true,
        items: 6,
        center: true,
    });
    $(".owl-click").each(function () {
        $(this).click(function () {
            var self = $(this);

            $('#galleryImg').empty();
            self.parent().find('.target').clone().appendTo('#galleryImg');

        })

    });
</script> @endpush @push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css"> @endpush