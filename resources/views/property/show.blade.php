@extends('layouts.app') @section('header') @endsection @section('content')


<div class="content">
    <div class="page-header">
        <div class="mdl-grid ">
            <div class="mdl-cell mdl-cell--9-col">
                <div class="mdl-color-text--grey-500 page-breadcrumb">
                    <!-- شقق للإيجار&gt; الرياض &gt; حى المروج -->
                    {{ (\App\Type::where('id', $property->type)->first()->$name)}}
                    
                    <i class="material-icons u-fix-icon-top">keyboard_arrow_left</i>
                    
                    {{ (\App\Purpose::where('id', $property->purpose)->first()->$name)}}
                    
                    <i class="material-icons u-fix-icon-top">keyboard_arrow_left</i>
                    <a href="#"  class="mdl-color-text--grey-500"  onclick="event.preventDefault();
                        document.getElementById('searchByCity').submit();">
                    {{ (\App\Region::find(\App\Region::find($property->region)->region_id)->$name)}}
                    <i class="material-icons u-fix-icon-top">keyboard_arrow_left</i>
                    </a>
                    <a href="#" class="mdl-color-text--grey-500" onclick="event.preventDefault();
                        document.getElementById('searchByRegoion').submit();">

                    {{ (\App\Region::find($property->region)->$name)}}
                    </a>
                    <form id="searchByRegoion" action="/properties/search" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                <input type="hidden" name=city value="{{(\App\Region::find(\App\Region::find($property->region)->region_id)->id)}}">
                                <input type="hidden" name="district" value="{{$property->region}}">
                            </form>
                            <form id="searchByCity" action="/properties/search" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                <input type="hidden" name=city value="{{(\App\Region::find(\App\Region::find($property->region)->region_id)->id)}}">
                            </form>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--3-col mdl-color-text--grey-500 u-text-left">
                <i class="material-icons u-fix-icon-top">access_time</i>
                <span v-text="lastUpdate('{{$property->updated_at}}')" class="page-date"></span>
            </div>
            <h4 class="page-title mdl-cell mdl-cell--12-col  u-primary-darker-color">{{ $property->title }}</h4>
        </div>

    </div>
    <div class="mdl-grid sticky-container">
        <div class="mdl-cell mdl-cell--9-col">
            <div class="mdl-card  mdl-shadow--2dp u-auto-width u-mbuttom16 gallery-card">
                <div class="gallery-img" id="galleryImg">
                @foreach($propertyImages as $propertyImage => $value)
                @if($propertyImage == 0)
                <img  src="{{ asset ('/upload/properties') }}/{{$value->path}}" alt="">
                     
                        @endif
                @endforeach
                </div>
                <div id="owl-example" class="owl-carousel owl-centered">
               
                    @foreach($propertyImages as $propertyImage)
                    <div class="item">
                        <div class="owl-click"></div>
                        <img class="target" src="{{ asset ('/upload/properties') }}/{{$propertyImage->path}}" alt="">
                    </div>
                    @endforeach
                    @if($property->youtube)
                    <div class="item">
                        <div class="owl-click"></div>
                      
                                <iframe class="target" width="80" height="80"
                                    src="{{$property->youtube}}">
                                </iframe>
                        </div>
                        @endif
                </div>
            </div>
            <div class="mdl-card  mdl-shadow--2dp u-auto-width u-height-auto u-padding-top-45 u-padding-bottom-15 u-mbuttom16 u-padding-side-20">
                <p class="u-padding-top-25 u-headline-color">{{ $property->description }}</p>
                <span class="card-label top-label-right has-primary-base-bg">التفاصيل</span>

            </div>
            <div class="mdl-card  mdl-shadow--2dp u-auto-width u-mbuttom30  u-padding-side-20">
                <table class="mdl-data-table u-full-width u-no-border">
                    <tbody>
                        <tr>
                            <td class="u-no-border-top header">رقم الأعلان</td>
                            <td class="u-no-border-top ">{{ $property->id }}</td>
                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">سعر السوق</td>
                            <td class="u-no-border-top">
                            {{ $property->price }}
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">سعر المتر</td>
                            <td class="u-no-border-top">
                            {{ $property->price / $property->area }}
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">تاريخ النشر</td>
                            <td class="u-no-border-top">
                            {{ $property->created_at }}
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">النوع</td>
                            <td class="u-no-border-top">
                            {{ \App\Type::find($property->type)->$name }}
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">الغرض</td>
                            <td class="u-no-border-top">
                            {{ \App\Purpose::find($property->purpose)->$name }}
                            
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">طربقة الدفع</td>
                            <td class="u-no-border-top">
                            {{ \App\PaymentMethod::find($property->payment_methods)->$name }}
                            
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">المساحة بالمتر</td>
                            <td class="u-no-border-top">
                            {{ $property->area }}
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">العلاقة بالعقار</td>
                            <td class="u-no-border-top">
                            {{ \App\Advertiser::find($property->advertiser_type)->$name }}
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">الغرف</td>
                            <td class="u-no-border-top">
                            {{ $property->rooms }}
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">الطابق</td>
                            <td class="u-no-border-top">
                            {{ $property->floor }}
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">الحمامات</td>
                            <td class="u-no-border-top">
                            {{ $property->bathrooms }}
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">سنة البناء</td>
                            <td class="u-no-border-top">
                            {{ $property->year_of_construction }}
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">نوع التشطيب</td>
                            <td class="u-no-border-top">
                            {{ \App\FinishType::find($property->finish_type)->$name }}  
                            
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">العنوان</td>
                            <td class="u-no-border-top">
                           {{$property->address}}  
                            
                            </td>

                        </tr>

                    </tbody>
                </table>

            </div>
            <div class="group-ad">
                <div class="group-ad__header">
                    <h6 class="group-ad__title">عروض اسعار</h6>
                </div>
                @foreach($propertyOffers as $offer)
                <div class="mdl-card mdl-card--pro  mdl-shadow--2dp u-auto-width u-mbuttom16 u-height-auto u-padding-top-45">

                    <div class="title">
                        <div class="mdl-avatar">
                            <img class="" src={{ asset ( 'images/face.png') }} alt="">
                        </div>
                        <h5 class="u-primary-darker-color">
                        {{ ($offer->user_id == 0 ) ? 'Unkowen' :\App\User::find($offer->user_id)->name }}
                        </h5>
                    </div>
                    <div class="contet">
                        <p class="u-headline-color">{{$offer->description}} </p>
                    </div>

                    <span class="card-label top-label-left has-secondary-base-bg">عرض السعر {{$offer->price}} ريال</span>
                </div>
              
              @endforeach
           
               
             

            </div>
        </div>
        <div class="mdl-cell mdl-cell--3-col sticky-item">
            <div class="mdl-card  mdl-shadow--2dp u-auto-width u-mbuttom16 u-padding-bottom-60 u-relative">
                <table class="mdl-data-table u-full-width u-no-border">
                    <tbody>
                        <tr>
                            <td class="u-no-border-top u-center" width="8%">{{ $property->area }}م</td>
                            <td class="u-no-border-top" width="2%">
                                <i class="material-icons">space_bar</i>
                            </td>
                            <td class="u-no-border-top  header">المساحة</td>
                        </tr>
                        <tr>
                            <td class="u-no-border-top u-center" width="8%">{{ $property->rooms }}</td>
                            <td class="u-no-border-top" width="2%">
                                <i class="material-icons">space_bar</i>
                            </td>
                            <td class="u-no-border-top  header">الغرف</td>
                        </tr>
                        <tr>
                            <td class="u-no-border-top u-center" width="8%">{{ $property->bathrooms }}</td>
                            <td class="u-no-border-top" width="2%">
                                <i class="material-icons">space_bar</i>
                            </td>
                            <td class="u-no-border-top  header">الحمامات</td>
                        </tr>
                    </tbody>
                </table>
                <span class="card-label bottom-label-left has-secondary-base-bg">{{ $property->price }} ريال</span>
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
                            {{ \App\User::find($property->user_id)->name }}  
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
            <addoffer-component :auth="{{json_encode(Auth::guest())}}" :propertyid="{{json_encode($property->id)}}"></addoffer-component>    
            
            </div>
        </div>
    </div>
    <div class="group-ad">
        <div class="group-ad__header">
            <h6 class="group-ad__title">إعلانات مشابهة</h6>
            <a href="#" class="group-ad__more">المزيد</a>

        </div>
        <div class="mdl-grid">
        @foreach($similarProperties as $property)
            <div class="mdl-cell mdl-cell--3-col">
                @include('components.vCard')
            </div>
            @endforeach
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