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
                    <a href="#" class="mdl-color-text--grey-500" onclick="event.preventDefault();
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
                <div class="">
                    <i class="material-icons u-fix-icon-top">eye</i>
                    <span>عدد مشاهدات</span>
                    <span>{{$property->hits}}</span>
                </div>
            </div>

            <h4 class="page-title mdl-cell mdl-cell--12-col  u-primary-darker-color">{{ $property->title }}</h4>
        </div>

    </div>
    <div class="mdl-grid sticky-container">
        <div class="mdl-cell mdl-cell--9-col">
            <div class="mdl-card  mdl-shadow--2dp u-auto-width u-mbuttom16 gallery-card">
                <!-- <div class="gallery-img" id="galleryImg">
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
                        <div class="owl-click"  ></div>
                      
                                <iframe v-bind:src="getYoutube('{{$property->youtube}}')" class="target" width="80" height="80">
                                </iframe>
                        </div>
                        @endif
                </div> -->
                <div class="light-slider">
                    <ul id="lightSlider">
                        @if($property->youtube)
                        <li v-bind:data-thumb="imgYoutube('{{$property->youtube}}')">

                            <iframe v-bind:src="getYoutube('{{$property->youtube}}')" id="youtubeVideo" class="target">
                            </iframe>
                        </li>
                        @endif @foreach($propertyImages as $propertyImage)
                        <li data-thumb="{{ asset ('/upload/properties') }}/{{$propertyImage->path}}">
                            <img class="target" src="{{ asset ('/upload/properties') }}/{{$propertyImage->path}}" alt="">
                        </li>
                        @endforeach
                    </ul>
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
                            <td class="u-no-border-top header" width="8%">نوع العقار</td>
                            <td class="u-no-border-top">
                                {{ \App\Type::find($property->type)->$name }}
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%"> الغرض من العقار</td>
                            <td class="u-no-border-top">
                                {{ \App\Purpose::find($property->purpose)->$name }}

                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">العلاقة بالعقار</td>
                            <td class="u-no-border-top">
                                @if($property->advertiser_type) {{ \App\Advertiser::find($property->advertiser_type)->$name }} @endif
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">الوجهات</td>
                            <td class="u-no-border-top">
                                @if ($property->overlooks != "") @foreach(explode(',', $property->overlooks) as $overlook) {{ \App\Overlook::find($overlook)->$name
                                }}, @endforeach @endif
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">المساحة بالمتر</td>
                            <td class="u-no-border-top">
                                {{ $property->area }}
                            </td>

                        </tr>
                        @if($property->purpose == "1" )
                        <tr>
                            <td class="u-no-border-top header" width="8%">سعر السوم</td>
                            <td class="u-no-border-top" v-text='addCommas({{ $property->bid_price }})'>


                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">سعر المتر</td>
                            <td class="u-no-border-top" v-text='addCommas({{ $property->price / $property->area }})'>

                            </td>

                        </tr>
                        @else
                        <tr>
                            <td class="u-no-border-top header" width="8%">الأيجار</td>
                            <td class="u-no-border-top">
                                {{ \App\Period::find($property->period)->$name }}
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">السعر المطلوب</td>
                            <td class="u-no-border-top" v-text="addCommas({{ $property->price}})">

                            </td>

                        </tr>
                        @endif

                        <tr>
                            <td class="u-no-border-top header" width="8%"> عدد الغرف</td>
                            <td class="u-no-border-top">
                                {{ $property->rooms }}
                            </td>

                        </tr>
                        <tr>
                            <td class="u-no-border-top header" width="8%">عدد الحمامات</td>
                            <td class="u-no-border-top">
                                {{ $property->bathrooms }}
                            </td>

                        </tr>
                        <tr>
                            @if ($property->type == "1")
                            <td class="u-no-border-top header " width="8%">الطابق</td>
                            @else
                            <td class="u-no-border-top header" width="8%">عدد الطوابق</td>
                            @endif
                            <td class="u-no-border-top">
                                {{ $property->floor }}
                            </td>

                        </tr>

                        <tr>
                            <td class="u-no-border-top header" width="8%">سنة البناء</td>
                            <td class="u-no-border-top">
                                {{ $property->year_of_construction }}
                            </td>

                        </tr>

                        <tr>
                            <td class="u-no-border-top header" width="8%">تاريخ النشر</td>
                            <td class="u-no-border-top" v-text="date('{{ $property->created_at }}')">

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
            @if(!$propertyOffers->isEmpty())
            <div class="group-ad">
                <div class="group-ad__header">
                    <h6 class="group-ad__title">عروض اسعار</h6>
                </div>
                @foreach($propertyOffers as $offer) @if(!$offer->reply_on)
                <div id="offer{{$offer->id}}" class="mdl-card mdl-card--pro   mdl-shadow--2dp u-auto-width u-mbuttom16 u-height-auto u-padding-top-45">

                    <div class="title">
                        <div class="mdl-avatar">
                            <img class="" src={{ asset ( 'images/face.png') }} alt="">
                        </div>
                        <h5 class="u-primary-darker-color">
                            {{ ($offer->user_id == 0 ) ? 'غير معروف' :\App\User::find($offer->user_id)->name }}
                        </h5>
                    </div>
                    <div class="contet">
                        <p class="u-headline-color">{{$offer->description}} </p>
                        @if(!Auth::guest() && (Auth::user()->id == $property->user_id ))
                    <span class="card-delete" @click="deleteOffer('{{$offer->id}}')">
                        <i class="material-icons">delete</i>
                    </span>
                    @elseif (!Auth::guest() && (Auth::user()->id == $offer->user_id ))
                    <a class="card-delete" @click="deleteOffer('{{$offer->id}}')">
                        <i class="material-icons">delete</i>
                    </a>
                    @endif
                    </div>
                    @if($offer->price)
                    <span class="card-label top-label-left has-secondary-base-bg" v-text="addCommas('{{$offer->price}}', ' عرض السعر ', ' ريال')"></span>
                    @endif
                    @if(!App\PropertyOffer::where('property_id', '=', $property->id)->where('reply_on', '=', $offer->id)->get()->isEmpty())
                    <div class="comments">
                        @foreach(App\PropertyOffer::where('property_id', '=', $property->id)->where('reply_on', '=', $offer->id)->get() as $subOffer)
                        <div class="comment">
                            <div class="title">
                                <div class="mdl-avatar">
                                    <img class="" src={{ asset ( 'images/face.png') }} alt="">
                                </div>
                                <h5 class="u-primary-darker-color">
                                    {{ ($subOffer->user_id == 0 ) ? 'غير معروف' :\App\User::find($subOffer->user_id)->name }}
                                </h5>
                            </div>
                            <div class="contet">
                                <p class="u-headline-color">{{$subOffer->description}} </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @if(!Auth::guest() && (Auth::user()->id == $property->user_id ))
                    <add-comment-component :propertyid="{{json_encode($property->id)}}" :offerid="{{json_encode($offer->id)}}"></add-comment-component>
                    @elseif (!Auth::guest() && (Auth::user()->id == $offer->user_id ))
                    <add-comment-component :propertyid="{{json_encode($property->id)}}" :offerid="{{json_encode($offer->id)}}"></add-comment-component>
                    @endif
                </div>
                @endif @endforeach

               



            </div>
            @endif
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
                @if($property->price_view == "0" || $property->purpose == "2")
                <span class="card-label bottom-label-left has-secondary-base-bg" v-text="addCommas('{{ $property->price}}', ' ريال')"> </span>
                @endif
            </div>
            <div class="mdl-card  mdl-shadow--2dp  u-auto-width  u-mbuttom16 u-height-auto has-actions">
                <a @click="mapDialog" class="map-overlay"></a>
                <div id="map" data-view="{{$property->map_view}}" style="height:250px; width:100%;"></div>
            </div>
            @if((!Auth::guest() && (Auth::user()->id != $property->user_id )) || Auth::guest())
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
                <div class="showMobile user-mobile hidden">
                    {{ \App\User::find($property->user_id)->mobile1 }}
                </div>
                <!-- <button  class="mdl-button  mdl-js-button mdl-js-ripple-effect mdl-button--colored ">
                    <i class="material-icons md-18">call</i>
                    <span class="showMobile">
                        اتصل الأن
                    </span>
                    <span class="showMobile hidden">
                        أخفاء الأتصال
                    </span>

                </button> -->
                <button id="showUserMobile" class="mdl-button  mdl-js-button mdl-js-ripple-effect  mdl-button--colored u-full-width ">
                    <i class="material-icons md-18">chat</i>
                    تواصل مع المعلن
                </button>
            </div>
            @endif
            <div class="mdl-card  mdl-shadow--2dp  u-padding-top-45 u-auto-width u-mbuttom16 u-height-auto  u-padding-side-20 u-padding-bottom-15">
                @if(!Auth::guest() && (Auth::user()->id != $property->user_id ))
                <addoffer-component :auth="{{json_encode(Auth::guest())}}" :propertyid="{{json_encode($property->id)}}"></addoffer-component>
                @elseif (Auth::guest())
                <addoffer-component :auth="{{json_encode(Auth::guest())}}" :propertyid="{{json_encode($property->id)}}"></addoffer-component>
                @else
                <a href="/properties/edit/{{$property->id}}" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center">تعديل</a>
                @endif

            </div>
            @if(!Auth::guest() && (Auth::user()->id != $property->user_id ))
            <div class="mdl-card  mdl-shadow--2dp  u-padding-top-45 u-auto-width u-mbuttom16 u-height-auto  u-padding-side-20 u-padding-bottom-15">
                <button @click="reportDialog" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center">تبليغ</button>
            </div>
            @endif
        </div>
    </div>
    @if(!$similarProperties->isEmpty())
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
    @endif
</div>

<report-component :propertyid="{{json_encode($property->id)}}"></report-component>
<mapview-component :propertylat="{{json_encode($property->lat)}}" :regionlat="{{ json_encode(\App\Region::find($property->region)->lat)}}"
    :regionlong="{{ json_encode(\App\Region::find($property->region)->long)}}" :propertylong="{{json_encode($property->long)}}"></mapview-component>
@endsection @push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.3/js/lightslider.min.js"></script>
<script>
    var player;
    // this function gets called when API is ready to use
    function onYouTubePlayerAPIReady() {
        // create the global player from the specific iframe (#video)
        player = new YT.Player('youtubeVideo', {});
    }
    var tag = document.createElement('script');
    tag.src = "//www.youtube.com/player_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    $(document).ready(function () {
        var currentTypeId = "{{$property->type}}"
        if (currentTypeId == "2") {
            $(".target-apartment").addClass('hidden');
            $(".target-villa").removeClass('hidden');
        } else {
            $(".target-villa").addClass('hidden');
            $(".target-apartment").removeClass('hidden');
        }
    });
    $('#lightSlider').lightSlider({
        gallery: true,
        rtl: true,
        item: 1,
        thumbItem: 10,
        currentPagerPosition: 'middle',
        thumbMargin: 15,
        prevHtml: '<i class="material-icons">navigate_before</i>',
        nextHtml: '<i class="material-icons">navigate_next</i>',
        onAfterSlide: function (el) {
            if (player) {
                if (el.getCurrentSlideCount() == 1) {
                    if (player.j.playerState == 2) {
                        player.playVideo();
                    }
                }
                else {
                    player.pauseVideo();
                    console.log()
                }
            }
        },
    });
    function initMap() {
        var lat = parseFloat('{{$property->lat}}');
        var long = parseFloat('{{$property->long}}');
        var uluru = new google.maps.LatLng(lat, long);
        var mapView = $("#map").attr('data-view');
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: uluru,
            disableDefaultUI: true
        });
        if (mapView == 1) {
            var marker = new google.maps.Marker({
                position: uluru,
                color: '#4ba6a2',
            });
            marker.setMap(map);
        } else if (mapView == 2) {
            var cityCircle = new google.maps.Circle({
                strokeColor: '#4ba6a2',
                fillColor: '#4ba6a2',
                strokeWeight: 0,
                fillOpacity: 0.45,
                strokeOpacity: 0.35,
                map: map,
                center: uluru,
                radius: 500
            });
        } else if (mapView == 3) {
            let regionLat = parseFloat('{{ (\App\Region::find($property->region)->lat)}}');
            let regionLong = parseFloat('{{ (\App\Region::find($property->region)->long)}}');
            var regionCenter = new google.maps.LatLng(regionLat, regionLong);
            map.setZoom(10);
            map.setCenter(regionCenter)
        }

    }
    $(document).ready(function () {
        initMap();
    });
    $('#showUserMobile').click(function () {
        $('.showMobile').toggleClass('hidden');
    })
</script>

</script> @endpush @push('styles')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.3/css/lightslider.min.css"> @endpush @push('begScripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuaq7NJkSDoz9ORGZzVopdHK6X-m8F6qs&libraries=places&&language=ar"></script> @endpush