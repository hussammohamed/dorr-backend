@extends('layouts.app') @section('header') @endsection @section('content')

<div class="content content-padding">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form id="properties-form" class="wizard-form" action="/properties/store" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div>
            <h3 class="hidden">first_step</h3>
            <section>
                <div class="section-header">
                    <h3>أضف اعلان</h3>
                </div>

                <div class="mdl-card mdl-shadow--2dp u-height-auto u-full-width mdl-grid u-mbuttom30">
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" required name="typeLabel" type="text" id="type" value="" readonly>
                            <input value="" type="hidden" name="type" />
                            <label for="type">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="type" class="mdl-textfield__label">النوع</label>
                            <ul for="type" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($types as $type)
                                <li class="mdl-menu__item" data-val="{{$type->id}}">{{$type->$name}}</li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" required name="purposeLabel" value="" type="text" id="purpose" readonly>
                            <input value="" type="hidden" name="purpose" />
                            <label for="purpose">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="purpose" class="mdl-textfield__label">القسم</label>
                            <ul for="purpose" id="purposesContainer" class="mdl-menu mdl-menu--bottom-left u-full-width mdl-js-menu">
                                @foreach($purposes as $purpose)
                                <li class="mdl-menu__item" data-val="{{$purpose->id}}">{{$purpose->$name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <h3 class="hidden">second_step</h3>
            <section class="u-hidden">
                <div class="section-header">
                    <h3>تفاصيل الأعلان</h3>
                </div>

                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" required name="title" type="text" id="sample20">
                            <label class="mdl-textfield__label" for="sample20">عنوان الأعلان</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <textarea class="mdl-textfield__input" required name="description" type="text" rows="5" id="sample5"></textarea>
                            <label class="mdl-textfield__label" for="sample5">تفاصيل الأعلان</label>
                        </div>
                    </div>
                </div>
                <div class="section-header">
                    <h3>تفاصيل العقار</h3>
                </div>

                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30">
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" required type="text" id="advertiser_type" value="" readonly tabIndex="-1">
                            <input value="" type="hidden" name="advertiser_type" />
                            <label for="advertiser_type">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="advertiser_type" class="mdl-textfield__label">العلاقة بالعقار</label>
                            <ul for="advertiser_type" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($advertiserTypes as $advertiserType)
                                <li class="mdl-menu__item" data-val="{{$advertiserType->id}}">{{$advertiserType->$name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" required name="area" type="number" id="sample9">
                            <label class="mdl-textfield__label" for="sample9">المساحة بالمتر المربع</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" required type="text" id="sample12" value="" readonly tabIndex="-1">
                            <input value="" type="hidden" name="payment_methods" />
                            <label for="sample1">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="sample12" class="mdl-textfield__label">طريقة الدفع</label>
                            <ul for="sample12" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($paymentMethods as $paymentMethod)
                                <li class="mdl-menu__item" data-val="{{$paymentMethod->id}}">{{$paymentMethod->$name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="dropdown-mul-2">
                            <input type="hidden" id="overlooks" name="overlooks">
                            <select style="display:none"  id="mul-2" multiple placeholder="تطل علي">
                                @foreach($overlooks as $overlook)                    
                                <option value="{{$overlook->id}}">{{$overlook->$name}}</option>                                                
                                @endforeach
                            </select>
                        </div>
                        

                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" required name="price" type="number" id="price">
                            <label class="mdl-textfield__label" for="price">السعر</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" required name="bid_price" type="number" id="bid_price">
                            <label class="mdl-textfield__label" for="bid_price">سعر السوم</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col mdl-checkbox-col">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="price_view">
                            <input type="hidden" name="price_view" value="0" />
                            <input type="checkbox" id="price_view" value="1" name="price_view" class="mdl-checkbox__input">
                            <span class="price_view">إخفاء السعر</span>
                        </label>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col target-hidden hidden">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" name="typeLabel" type="text" id="income_period" value="" readonly>
                            <input value="" type="hidden" name="income_period" />
                            <label for="income_period">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="income_period" class="mdl-textfield__label">فترة الدخل</label>
                            <ul for="income_period" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($incomePeriods as $incomePeriod)
                                <li class="mdl-menu__item" data-val="{{$incomePeriod->id}}">{{$incomePeriod->$name}}</li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col target-hidden hidden">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" name="income" type="number" id="income">
                            <label class="mdl-textfield__label" for="income">الدخل</label>
                        </div>
                    </div>


                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" required name="rooms" type="number" id="rooms" value="">
                            <label for="rooms" class="mdl-textfield__label">عدد الغرف</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" required name="floor" type="number" id="floor" value="">
                            <label for="floor" class="mdl-textfield__label">الطابق</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" required name="bathrooms" type="number" id="bathrooms"
                                            value="">
                                        <label for="bathrooms" class="mdl-textfield__label">الحمامات</label>
                                    </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label ">
                            <input class="mdl-textfield__input" required name="year_of_construction" type="number" id="sampl6" value="">

                            <label for="sampl6" class="mdl-textfield__label">سنة البناء</label>

                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">

                            <input class="mdl-textfield__input" required type="text" id="sampl7" value="" readonly tabIndex="-1">
                            <input value="" type="hidden" name="finish_type" />
                            <label for="sampl7">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="sampl7" class="mdl-textfield__label">نوع التشطيب</label>
                            <ul for="sampl7" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($finishTypes as $finishType)
                                <li class="mdl-menu__item" data-val="{{$finishType->id}}">{{$finishType->$name}}</li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="section-header">
                    <h3>تفاصيل العنوان</h3>
                </div>

                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30">
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input city_id_js" required type="text" id="cityId" value="" readonly tabIndex="-1">
                            <input value="" class="hidden-input" type="hidden" />
                            <label for="cityId">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="cityId" class="mdl-textfield__label">المدينة</label>
                            <ul for="cityId" id="cityContianer" class="mdl-menu mdl-menu--bottom-left u-full-width mdl-js-menu">
                                @foreach($cities as $city)
                                <li class="mdl-menu__item" data-lat='{{$city->lat}}' data-long='{{$city->long}}' data-val="{{$city->id}}">{{$city->$name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label  getmdl-select__city  getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" required type="text" id="district" value="" readonly tabIndex="-1">
                            <input type="hidden" name="region" required value="">
                            <label for="district">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="district" class="mdl-textfield__label">الحي</label>
                            <ul for="district" id="districtContianer" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">

                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" required name="address" type="text" id="mapSearch" placeholder="">
                            <label class="mdl-textfield__label" for="mapSearch">عنوان العقار</label>
                            <input class="mdl-textfield__input" type="hidden" name="lat" id="lat" placeholder="">
                            <input class="mdl-textfield__input" type="hidden" id="long" name="long" placeholder="">
                        </div>
                    </div>
                    <div id="map"></div>
                </div>
            </section>
            <h3 class="hidden">third_step</h3>
            <section class="u-hidden">
                <div class="section-header">
                    <h3>صور العقار</h3>
                </div>
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
                    <div id="files" class="mdl-cell mdl-cell--12-col"></div>
                </div>
                <div class="section-header">
                    <h3>أضف فيديو</h3>
                </div>
                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30 u-height-auto">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" name="youtube" type="text" id="youtube">
                            <label class="mdl-textfield__label" for="youtube">رابط الفيديو (يوتيوب) </label>
                        </div>
                    </div>
                </div>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
                    <input type="checkbox" id="checkbox-1" name="checkbox[]" class="mdl-checkbox__input">
                    <span class="mdl-checkbox__label">موافق على الشروط والأحكام</span>
                </label>
            </section>
        </div>
    </form>
</div>

@endsection @push('styles') @endpush @push('scripts')
<script src={{ asset( 'js/jquery.steps.min.js') }}></script>
<script src={{ asset( 'js/jquery.dropdown.min.js') }}></script>
<script>
    var form = $("#properties-form");
    form.validate({
        rules: {
            "checkbox[]": {
                required: true,
                minlength: 1
            }
        },
        highlight: function (element) {
            $(element)
                .closest(".mdl-textfield,.mdl-checkbox")
                .addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element)
                .closest(".mdl-textfield,.mdl-checkbox")
                .removeClass("is-invalid");
        },
        errorElement: "span",
        errorClass: "mdl-textfield__error",
        errorPlacement: function (error, element) {

            error.insertAfter(element);
        }
    });
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "fade",
        onInit: function (event, currentIndex, newIndex) {
            var currentStep = form.children("div").steps("getStep", currentIndex);
            window.location.hash = currentStep.title;
            $('.dropdown-mul-2').dropdown({
                limitCount: 5,
                searchable: false
            });
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            $(".u-hidden").removeClass('u-hidden');
            console.log(newIndex, currentIndex)
            if (form.valid() && $("#district").valid()) {
                $(".is-invalid").removeClass("is-invalid");
                return true;
            } else if (newIndex < currentIndex) {
                return true;
            } else {
                return false;
            }


        },
        onStepChanged: function (event, currentIndex, newIndex) {
            var currentStep = form.children("div").steps("getStep", currentIndex);
            window.location.hash = currentStep.title;
            initMap();

        },
        onFinished: function (event, currentIndex) {
            if (form.valid()) {
                $("#overlooks").val(($("#mul-2").val()).toString())
                $("#properties-form").submit();
            } else {
                return false;
            }
        },
        labels: {
            next: "متابعة",
            previous: "الرجوع",
            finish: "حفظ"

        }
    });
    var $wizard = form.children("div");
    $(window).bind('hashchange', function (e) {
        var hash = location.hash.replace("#", "");

        $steps = $wizard.data("steps");

        if (hash == "") {
            var firstStep = $wizard.steps("getStep", 0);
            hash = firstStep.title;
        }

        jQuery.each($steps, function (indexInArray, valueOfElement) {
            if (valueOfElement.title == hash) {

                var $currentIndex = $wizard.steps("getCurrentIndex");
                var diferrence = indexInArray - $currentIndex;

                for (var i = 0; i < diferrence; i++) {
                    $wizard.steps("next");
                }

                for (var i = 0; i > diferrence; i--) {
                    $wizard.steps("previous");
                }
            }
        });
    });
</script>
<script>
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

        //change center of map
        $("#district").change(function () {
            var lat = $("#districtContianer").find(".selected").attr("data-lat");
            var long = $("#districtContianer").find(".selected").attr("data-long");
            var currentCenter = new google.maps.LatLng(lat, long);
            map.setCenter(currentCenter)
            map.setZoom(12);
        });
        $("#cityId").change(function () {
            var lat = $("#cityContianer").find(".selected").attr("data-lat");
            var long = $("#cityContianer").find(".selected").attr("data-long");
            var currentCenter = new google.maps.LatLng(lat, long);
            map.setCenter(currentCenter)
            map.setZoom(9);
        });

    }
    $("#purpose").change(function () {
        var purposeId = $("#purposesContainer").find(".selected").attr("data-val");
        if (purposeId == "1") {
            $(".target-hidden").removeClass('hidden');
        } else {
            $(".target-hidden").addClass('hidden');
        }
    });


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuaq7NJkSDoz9ORGZzVopdHK6X-m8F6qs&libraries=places&&language=ar"></script>
<script>
    function readUrl(input) {
        var files = event.target.files;
        var filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
            if (input.files && input.files[0]) {
                let f = files[i];
                let reader = new FileReader();
                reader.onload = (e) => {
                    let file = e.target;
                    //let imgName = input.files[0].name;
                    //input.setAttribute("data-title", imgName);
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

    }</script> @endpush