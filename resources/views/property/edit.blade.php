@extends('layouts.app') @section('header') @endsection @section('content')


<div class="content">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form id="properties-form" class="wizard-form" action="/properties/update" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$property->id}}">
        <div class="page-header">
            <div class="mdl-grid ">
                <div class="mdl-textfield mdl-js-textfield mdl-cell mdl-cell--6-col mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" required name="title" type="text" value="{{$property->title}}" id="sample20">
                    <label class="mdl-textfield__label" for="sample20">عنوان الأعلان</label>
                </div>
            </div>

        </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30">
                    <div class="mdl-cell mdl-cell--12-col p-y-1">
                        <div class=" m-b-1">
                            <div class="form-group inputDnD">
                                <i class="material-icons">add_a_photo</i>
                                <input type="file" class="form-control-file text-primary font-weight-bold" id="inputFile" accept="image/*" onchange="readUrl(this)"
                                    data-title="اسحب الصورة هنا للإضافة" name="attachment[]" multiple>
                                <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored" onclick="document.getElementById('inputFile').click()">او إرفاق صور</button>
                            </div>
                        </div>

                    </div>
                    <div id="files" class="mdl-cell mdl-cell--12-col">
                        @foreach($propertyImages as $propertyImage)
                        <div class="pip" id="{{$propertyImage->id}}">
                            <img class="imageThumb" src="{{ asset ('/upload/properties') }}/{{$propertyImage->path}}" />
                            <br/>
                            <div class="remove" @click="deleteImage({{$propertyImage->id}})">
                                <i class="material-icons">delete</i>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30 u-height-auto">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" name="youtube" value="{{$property->youtube}}" type="text" id="youtube">
                            <label class="mdl-textfield__label" for="youtube">رابط الفيديو (يوتيوب) </label>
                        </div>
                    </div>
                </div>
                <div class="mdl-card over-flow-hidden  mdl-shadow--2dp u-auto-width u-height-auto u-padding-top-45 u-padding-bottom-15 u-mbuttom16 u-padding-side-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                        <textarea class="mdl-textfield__input" required name="description" type="text" rows="5" id="sample5">{{$property->description}}</textarea>
                        <label class="mdl-textfield__label" for="sample5">تفاصيل الأعلان</label>
                    </div>
                    <span class="card-label top-label-right has-primary-base-bg">التفاصيل</span>

                </div>
                <div class="mdl-card over-visable mdl-shadow--2dp u-auto-width u-mbuttom30  u-padding-side-20">
                    <table class="mdl-data-table u-full-width u-no-border">
                        <tbody>
                            <!-- <tr>
                            <td class="u-no-border-top header">رقم الأعلان</td>
                            <td class="u-no-border-top ">{{ $property->id }}</td>
                        </tr> -->
                            <!-- <tr>
                            <td class="u-no-border-top header" width="8%">سعر المتر</td>
                            <td class="u-no-border-top">
                            {{ $property->price_per_meter }}
                            </td>

                        </tr> -->
                            <!-- <tr>
                            <td class="u-no-border-top header" width="8%">تاريخ النشر</td>
                            <td class="u-no-border-top">
                                {{ $property->created_at }}
                            </td>

                        </tr> -->
                            <tr>
                                <td class="u-no-border-top header" width="8%">النوع</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                                        <input class="mdl-textfield__input" required type="text" id="type" value="" readonly>
                                        <input value="" type="hidden" name="type" />
                                        <label for="type">
                                            <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                        </label>
                                        <label for="type" class="mdl-textfield__label"></label>
                                        <ul for="type" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                            @foreach($types as $type) @if ($type->id == $property->type)
                                            <li class="mdl-menu__item" data-val="{{$type->id}}" data-selected="true">{{$type->$name}}</li>
                                            @else
                                            <li class="mdl-menu__item" data-val="{{$type->id}}">{{$type->$name}}</li>
                                            @endif @endforeach

                                        </ul>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td class="u-no-border-top header" width="8%">القسم</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                                        <input class="mdl-textfield__input" required value="" type="text" id="purpose" readonly>
                                        <input value="" type="hidden" name="purpose" />
                                        <label for="purpose">
                                            <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                        </label>
                                        <label for="purpose" class="mdl-textfield__label"></label>
                                        <ul for="purpose" class="mdl-menu mdl-menu--bottom-left u-full-width mdl-js-menu">
                                            @foreach($purposes as $purpose) @if($purpose->id == $property->purpose)
                                            <li class="mdl-menu__item" data-val="{{$purpose->id}}" data-selected="true">{{$purpose->$name}}</li>
                                            @else
                                            <li class="mdl-menu__item" data-val="{{$purpose->id}}">{{$purpose->$name}}</li>
                                            @endif @endforeach
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td class="u-no-border-top header" width="8%">المدينة</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                                        <input class="mdl-textfield__input city_id_js" required type="text" id="cityId" value="" readonly tabIndex="-1">
                                        <input value="" class="hidden-input" type="hidden" />
                                        <label for="cityId">
                                            <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                        </label>
                                        <label for="cityId" class="mdl-textfield__label"></label>
                                        <ul for="cityId" class="mdl-menu mdl-menu--bottom-left u-full-width mdl-js-menu">
                                            @foreach($cities as $city) @if ($city->id == \App\Region::find($property->region)->region_id)
                                            <li class="mdl-menu__item" data-val="{{$city->id}}" data-selected="true">{{$city->$name}}</li>
                                            @else
                                            <li class="mdl-menu__item" data-val="{{$city->id}}">{{$city->$name}}</li>
                                            @endif @endforeach
                                        </ul>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td class="u-no-border-top header" width="8%">الحي</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label  getmdl-select__city  getmdl-select getmdl-select__fix-height">
                                        <input class="mdl-textfield__input" required type="text" id="district" value="" readonly tabIndex="-1">
                                        <input id="currentRegion" type="hidden" name="region" value="{{$property->region}}">
                                        <label for="district">
                                            <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                        </label>
                                        <label for="district" class="mdl-textfield__label"></label>
                                        <ul for="district" id="districtContianer" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">

                                        </ul>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td class="u-no-border-top header" width="8%">تطل علي</td>
                                <td class="u-no-border-top">
                                        
                                    <div class="dropdown-mul-2">
                                        <input type="hidden" id="overlooks" name="overlooks">
                                        <select style="display:none" id="mul-2" multiple>
                                            @foreach($overlooks as $overlook)
                                            <option value="{{$overlook->id}}">{{$overlook->$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="u-no-border-top header" width="8%">فترة الدخل</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                                        <input class="mdl-textfield__input" name="typeLabel" type="text" id="period" value="" readonly>
                                        <input value="" type="hidden" name="period" />
                                        <label for="period">
                                            <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                        </label>
                                        <label for="period" class="mdl-textfield__label"></label>
                                        <ul for="period" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                            @foreach($incomePeriods as $incomePeriod) @if ($incomePeriod->id == $property->period)
                                            <li class="mdl-menu__item" data-val="{{$incomePeriod->id}}" data-selected="true">{{$incomePeriod->$name}}</li>
                                            @else
                                            <li class="mdl-menu__item" data-val="{{$incomePeriod->id}}">{{$incomePeriod->$name}}</li>
                                            @endif @endforeach

                                        </ul>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td class="u-no-border-top header" width="8%">الدخل</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                                        <input class="mdl-textfield__input" name="income" value="{{$property->income}}" type="number" id="income">
                                        <label class="mdl-textfield__label" for="income"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="u-no-border-top header" width="8%">المساحة بالمتر المربع</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                                        <input class="mdl-textfield__input" required name="area" value="{{$property->area}}" type="number" id="sample9">
                                        <label class="mdl-textfield__label" for="sample9"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="u-no-border-top header" width="8%">الطابق</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" required name="floor" type="number" value="{{$property->floor}}" id="floor" value="">
                                        <label for="floor" class="mdl-textfield__label"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="u-no-border-top header" width="8%">عدد الغرف</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" required name="rooms" type="number" value="{{$property->rooms}}" id="rooms" value="">
                                        <label for="rooms" class="mdl-textfield__label"> </label>
                                    </div>
                                </td>

                            </tr>

                            <tr>
                                <td class="u-no-border-top header" width="8%">الحمامات</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" required name="bathrooms" type="number" value="{{$property->bathrooms}}" id="bathrooms"
                                            value="">
                                        <label for="bathrooms" class="mdl-textfield__label"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="u-no-border-top header" width="8%">سنة البناء</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label ">
                                        <input class="mdl-textfield__input" required name="year_of_construction" value="{{$property->year_of_construction}}" type="number"
                                            id="sampl6" value="">

                                        <label for="sampl6" class="mdl-textfield__label"> </label>

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="u-no-border-top header" width="8%">السعر</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                                        <input class="mdl-textfield__input" required name="price" type="number" value="{{$property->price}}" id="price">
                                        <label class="mdl-textfield__label" for="price"></label>
                                    </div>
                                    <div>
                                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="price_view">
                                            <input type="hidden" name="price_view" value="0" /> @if($property->price_view == "1" )
                                            <input type="checkbox" id="price_view" value="1" name="price_view" class="mdl-checkbox__input" checked> @else
                                            <input type="checkbox" id="price_view" value="1" name="price_view" class="mdl-checkbox__input"> @endif
                                            <span class="price_view">إخفاء السعر</span>
                                        </label>
                                    </div>


                                </td>
                            </tr>
                            <tr>
                                <td class="u-no-border-top header" width="8%">سعر السوم</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                                        <input class="mdl-textfield__input" required name="bid_price" type="number" value="{{$property->bid_price}}" id="bid_price">
                                        <label class="mdl-textfield__label" for="bid_price"></label>
                                    </div>
                                </td>
                            </tr>


                            <tr>

                                <td class="u-no-border-top header" width="8%">العلاقة بالعقار</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                                        <input class="mdl-textfield__input" required type="text" id="advertiser_type" value="" readonly tabIndex="-1">
                                        <input value="" type="hidden" name="advertiser_type" />
                                        <label for="advertiser_type">
                                            <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                        </label>
                                        <label for="advertiser_type" class="mdl-textfield__label"></label>
                                        <ul for="advertiser_type" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                            @foreach($advertiserTypes as $advertiserType) @if ($advertiserType->id == $property->advertiser_type)
                                            <li class="mdl-menu__item" data-val="{{$advertiserType->id}}" data-selected="true">{{$advertiserType->$name}}</li>
                                            @else
                                            <li class="mdl-menu__item" data-val="{{$advertiserType->id}}">{{$advertiserType->$name}}</li>
                                            @endif @endforeach
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td class="u-no-border-top header" width="8%">نوع التشطيب</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">

                                        <input class="mdl-textfield__input" required type="text" id="sampl7" value="" readonly tabIndex="-1">
                                        <input value="" type="hidden" name="finish_type" />
                                        <label for="sampl7">
                                            <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                        </label>
                                        <label for="sampl7" class="mdl-textfield__label"></label>
                                        <ul for="sampl7" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                            @foreach($finishTypes as $finishType) @if ($finishType->id == $property->finish_type)
                                            <li class="mdl-menu__item" data-val="{{$finishType->id}}" data-selected="true">{{$finishType->$name}}</li>
                                            @else
                                            <li class="mdl-menu__item" data-val="{{$finishType->id}}">{{$finishType->$name}}</li>
                                            @endif @endforeach
                                        </ul>

                                    </div>

                                </td>

                            </tr>
                            <tr>
                                <td class="u-no-border-top header" width="8%">طريقة الدفع</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                                        <input class="mdl-textfield__input" required type="text" id="sample12" value="" readonly tabIndex="-1">
                                        <input value="" type="hidden" name="payment_methods" />
                                        <label for="sample1">
                                            <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                        </label>
                                        <label for="sample12" class="mdl-textfield__label"> </label>
                                        <ul for="sample12" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                            @foreach($paymentMethods as $paymentMethod) @if ($paymentMethod->id == $property->payment_methods)
                                            <li class="mdl-menu__item" data-val="{{$paymentMethod->id}}" data-selected="true">{{$paymentMethod->$name}}</li>
                                            @else
                                            <li class="mdl-menu__item" data-val="{{$paymentMethod->id}}">{{$paymentMethod->$name}}</li>
                                            @endif @endforeach
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="u-no-border-top header" width="8%">تطل علي</td>
                                <td class="u-no-border-top">
                                    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                                        <input class="mdl-textfield__input" required type="text" id="sampl1" value="" readonly tabIndex="-1">
                                        <input value="" type="hidden" name="overlooks" />
                                        <label for="sampl1">
                                            <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                        </label>
                                        <label for="sampl1" class="mdl-textfield__label"> </label>
                                        <ul for="sampl1" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                            @foreach($overlooks as $overlook) @if ($overlook->id == $property->overlooks)
                                            <li class="mdl-menu__item" data-val="{{$overlook->id}}" data-selected="true">{{$overlook->$name}}</li>
                                            @else
                                            <li class="mdl-menu__item" data-val="{{$overlook->id}}">{{$overlook->$name}}</li>
                                            @endif @endforeach
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>
                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" required name="address" value="{{$property->address}}" type="text" id="mapSearch" placeholder="">
                            <label class="mdl-textfield__label" for="mapSearch">عنوان العقار</label>
                            <input class="mdl-textfield__input" value="{{$property->lat}}" type="hidden" name="lat" id="lat" placeholder="">
                            <input class="mdl-textfield__input" value="{{$property->long}}" type="hidden" id="long" name="long" placeholder="">
                        </div>
                    </div>
                    <div id="map"></div>
                </div>
            </div>
        </div>
        <div class="u-center">

            <a id="submitInput" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center">تعديل</a>
            <a href="{{asset('myAccount/Properties')}}" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised u-margin-sides16">ألغاء</a>
        </div>
    </form>
</div>
@endsection @push('scripts')
<script>
    var form = $("#properties-form");
    form.validate({
        highlight: function (element) {
            $(element)
                .closest(".mdl-textfield")
                .addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element)
                .closest(".mdl-textfield")
                .removeClass("is-invalid");
        },
        errorElement: "span",
        errorClass: "mdl-textfield__error",
        errorPlacement: function (error, element) {

            error.insertAfter(element);
        }
    });
    $('#submitInput').click(function(){
            if (form.valid()) {
                var overlooks = ($("#mul-2").val()).toString()
                $("#overlooks").val(overlooks)
                $("#properties-form").submit();
            } else {
                return false;
            }
        });
    function initMap() {
        var uluru = new google.maps.LatLng(23.128363, 37.199707);
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: uluru,
            disableDefaultUI: true
        });
        var markersArray = [];
        // Deletes all markers in the array by removing references to them
        function deleteOverlays() {
            if (markersArray) {
                for (i in markersArray) {
                    markersArray[i].setMap(null);
                }
                markersArray.length = 0;
            }
        }

        function placeMarker(location) {
            // first remove all markers if there are any
            deleteOverlays();

            var marker = new google.maps.Marker({
                position: location,
                map: map
            });

            // add marker in markers array
            markersArray.push(marker);

            //map.setCenter(location);
        }
        /***************search box****************/
        var searchBox = new google.maps.places.SearchBox(document.getElementById('mapSearch'));
        google.maps.event.addListener(searchBox, 'places_changed', function () {
            deleteOverlays();
            var places = searchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            var i, place;
            for (i = 0; place = places[i]; i++) {
                bounds.extend(place.geometry.location);
                // place a marker
                placeMarker(place.geometry.location);
                // display the lat/lng
                document.getElementById("lat").value = place.geometry.location.lat();
                document.getElementById("long").value = place.geometry.location.lng();

            }
            map.fitBounds(bounds);
            map.setZoom(15);

        });
        /***************map click*********/
        var latlng = new google.maps.LatLng(41, 29);
        google.maps.event.addListener(map, "click", function (event) {
            // place a marker
            placeMarker(event.latLng);
            // display the lat/lng 
            document.getElementById("lat").value = event.latLng.lat();
            document.getElementById("long").value = event.latLng.lng();
            geocodeLatLng(geocoder, map, infowindow);
        });
        //lat and long input

        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;

        function geocodeLatLng(geocoder, map, infowindow) {
            var lat = document.getElementById("lat").value;
            var long = document.getElementById("long").value;
            var latlong = new google.maps.LatLng(lat, long);
            geocoder.geocode({
                'location': latlong
            }, function (results, status) {
                if (status === 'OK') {
                    if (results[1]) {
                        var marker = new google.maps.Marker({
                            position: latlong,
                            map: map
                        });
                        markersArray.push(marker);
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                        document.getElementById("mapSearch").value = (results[0].formatted_address);
                    }
                }
            });
        }
        var currentLat = document.getElementById("lat").value;
        var currentLong = document.getElementById("long").value;
        geocodeLatLng(geocoder, map, infowindow);

    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuaq7NJkSDoz9ORGZzVopdHK6X-m8F6qs&libraries=places&&language=ar&callback=initMap"></script>
<script src={{ asset( 'js/jquery.dropdown.min.js') }}></script>
<script>

     
        $(document).ready(function () {
                var overlooks = '{{$property->overlooks}}';
                var ovelooksArr = overlooks.split(",");
                $("#mul-2").val(ovelooksArr)
                $('.dropdown-mul-2').dropdown({
                    limitCount: 5,
                    searchable: false
                });
                $(".city_id_js").change(function () {
                    var value = $(this).parent().find(".hidden-input").val();
                    $.ajax({
                        url: '/api/v1/regions/' + value + '',
                        type: "GET",
                        success: function (_response) {
                            self.cities = _response.data
                            var districtContianer = $('#districtContianer')
                            var currentRegion = $('#currentRegion').val();
                            if (districtContianer.length) {
                                districtContianer.empty();
                                for (let i = 0; i < self.cities.length; i++) {
                                    if (self.cities[i].id == currentRegion) {
                                        districtContianer.append('<li class="mdl-menu__item" data-long=' + self.cities[i].location.long + ' data-lat=' + self.cities[i].location.lat + ' data-val=' + self.cities[i].id + ' data-selected="true">' + self.cities[i].title + '</li>');
                                    } else {
                                        districtContianer.append('<li class="mdl-menu__item"  data-long=' + self.cities[i].location.long + ' data-lat=' + self.cities[i].location.lat + ' data-val=' + self.cities[i].id + '>' + self.cities[i].title + '</li>');
                                    }
                                }
                            }

                        },
                        complete: function (_response) {

                            getmdlSelect.init('.getmdl-select__city');


                        },
                    });
                });

            })
        
       

    function readUrl(input) {
        var files = event.target.files;
        var filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
            if (input.files && input.files[0]) {
                let f = files[i];
                let reader = new FileReader();
                reader.onload = (e) => {
                    let file = e.target;
                    $("<div class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\"/>" +
                        "<br/><div class=\"remove\"><i class=\"material-icons\">delete</i></div>" +
                        "</div>").appendTo("#files");
                    $(".remove").click(function () {
                        $(this).parent(".pip").remove();
                    });

                }
                reader.readAsDataURL(f);
            }
        }

    }</script>@endpush @push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css"> @endpush