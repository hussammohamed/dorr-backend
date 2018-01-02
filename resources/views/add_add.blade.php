@extends('layouts.app') @section('header') @endsection @section('content')

<div class="content content-padding">

    <form id="example-form" class="wizard-form" action="properties/store"  method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div>
            <h3 class="hidden"></h3>
            <section>
                <div class="section-header">
                    <h3>أضف اعلان</h3>
                </div>
                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30">
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" type="text" id="sample1" value="" readonly tabIndex="-1">
                            <label for="sample1">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="sample1" class="mdl-textfield__label">النوع</label>
                            <ul for="sample1" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($types as $type)
                                <li class="mdl-menu__item" data-val="{{$type->id}}">{{$type->name}}</li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" type="text" id="sample2" value="" readonly tabIndex="-1">
                            <label for="sample2">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="sample2" class="mdl-textfield__label">القسم</label>
                            <ul for="sample2" class="mdl-menu mdl-menu--bottom-left u-full-width mdl-js-menu">
                                @foreach($purposes as $purpose)
                                <li class="mdl-menu__item" data-val="{{$purpose->id}}">{{$purpose->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" type="text" id="sample28" value="" readonly tabIndex="-1">
                            <label for="sample28">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="sample28" class="mdl-textfield__label">المدينة</label>
                            <ul for="sample28" class="mdl-menu mdl-menu--bottom-left u-full-width mdl-js-menu">
                                @foreach($cities as $city)
                                <li class="mdl-menu__item" data-val="{{$city->id}}">{{$city->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-textfield mdl-js-textfield u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" type="text" id="sample29" value="" readonly tabIndex="-1">
                            <label for="sample29">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="sample29" class="mdl-textfield__label">الحي</label>
                            <ul for="sample29" class="mdl-menu mdl-menu--bottom-left u-full-width mdl-js-menu" id="distric_list">
                                <li class="mdl-menu__item" data-val="DE">أيجار</li>
                                <li class="mdl-menu__item" data-val="BY">تمليك</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <h3 class="hidden"></h3>
            <section>
                <div class="section-header">
                    <h3>تفاصيل الأعلان</h3>
                </div>

                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="sample20">
                            <label class="mdl-textfield__label" for="sample20">عنوان الأعلان</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <textarea class="mdl-textfield__input" type="text" rows="5" id="sample5"></textarea>
                            <label class="mdl-textfield__label" for="sample5">تفاصيل الأعلان</label>
                        </div>
                    </div>
                </div>
                <div class="section-header">
                    <h3>تفاصيل العقار</h3>
                </div>

                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30">
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="sample8">
                            <label class="mdl-textfield__label" for="sample8">مالك العقار</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="sample9">
                            <label class="mdl-textfield__label" for="sample9">المساحة بالمتر المربع</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="sample10">
                            <label class="mdl-textfield__label" for="sample10">السعر</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" type="text" id="sample12" value="" readonly tabIndex="-1">
                            <label for="sample1">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="sample12" class="mdl-textfield__label">طريقة الدفع</label>
                            <ul for="sample12" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($paymentMethods as $paymentMethod)
                                <li class="mdl-menu__item" data-val="{{$paymentMethod->id}}">{{$paymentMethod->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" type="text" id="sampl1" value="" readonly tabIndex="-1">
                            <label for="sampl1">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="sampl1" class="mdl-textfield__label">تطل علي</label>
                            <ul for="sampl1" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                @foreach($overlooks as $overlook)
                                <li class="mdl-menu__item" data-val="{{$overlook->id}}">{{$overlook->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="sampl2" value="" readonly tabIndex="-1">
                            <label for="sampl2" class="mdl-textfield__label">عدد الغرف</label>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                            <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="sampl3" value="" readonly tabIndex="-1">
                                <label for="sampl3" class="mdl-textfield__label">الطابق</label>
                            </div>
                        </div>
                    <div class="mdl-cell mdl-cell--3-col">
                        <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" type="text" id="sampl4" value="" readonly tabIndex="-1">
                            <label for="sampl4">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                            </label>
                            <label for="sampl4" class="mdl-textfield__label">الحمامات</label>
                            <ul for="sampl4" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                <li class="mdl-menu__item" data-val="DE">1</li>
                                <li class="mdl-menu__item" data-val="BY">2</li>
                                <li class="mdl-menu__item" data-val="RU">3</li>
                                <li class="mdl-menu__item" data-val="RU">4</li>
                                <li class="mdl-menu__item" data-val="RU">5</li>
                                <li class="mdl-menu__item" data-val="RU">6</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                            <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label ">
                                <input class="mdl-textfield__input" type="text" id="sampl6" value="" readonly tabIndex="-1">
                               
                                <label for="sampl6" class="mdl-textfield__label">سنة البناء</label>
                                
                            </div>
                        </div>
                        <div class="mdl-cell mdl-cell--3-col">
                                <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label">
                                    
                                    <input class="mdl-textfield__input" type="text" id="sampl7" value="" readonly tabIndex="-1">
                                    <label for="sampl7">
                                        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                    </label>
                                    <label for="sampl7" class="mdl-textfield__label">نوع التشطيب</label>
                                    <ul for="sampl7" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                        @foreach($finishTypes as $finishType)
                                        <li class="mdl-menu__item" data-val="{{$finishType->id}}">{{$finishType->name}}</li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                </div>
                <div class="section-header">
                    <h3>تفاصيل العنوان</h3>
                </div>

                <div class="mdl-card mdl-shadow--2dp u-full-width mdl-grid u-mbuttom30">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
                            <input class="mdl-textfield__input" type="text" id="mapSearch" placeholder="">
                            <label class="mdl-textfield__label" for="mapSearch">عنوان العقار</label>
                        </div>
                    </div>
                    <div id="map"></div>
                </div>
            </section>
            <h3 class="hidden"></h3>
            <section>
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
                                <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored" onclick="document.getElementById('inputFile').click()">او تصفح</button>
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
                            <input class="mdl-textfield__input" type="text" id="youtube">
                            <label class="mdl-textfield__label" for="youtube">رابط الفيديو (يوتيوب) </label>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </form>
</div>

@endsection @push('styles') @endpush @push('scripts')
<script src={{ asset( 'js/jquery.steps.min.js') }}></script>
<script>
    var form = $("#example-form");
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "fade",
        onStepChanged: function (event, currentIndex, newIndex) {
            initMap();
            return true;
        },
        onFinished: function (event, currentIndex) {
            alert("Submitted!");
        },
        labels: {
            next: "متابعة",
            previous: "الرجوع",
            finish: "حفظ"

        }
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
                //document.getElementById("lat").value = place.geometry.location.lat();
                //document.getElementById("long").value = place.geometry.location.lng();
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
            //document.getElementById("lat").value = event.latLng.lat();
            //document.getElementById("long").value = event.latLng.lng();
        });
        //lat and long input
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
        // $("#lat, #long").change(function () {
        //     deleteOverlays();
        //     geocodeLatLng(geocoder, map, infowindow);
        // });

        function geocodeLatLng(geocoder, map, infowindow) {
            var lat = document.getElementById("lat").value;
            var long = document.getElementById("long").value;
            var latlong = new google.maps.LatLng(lat, long);
            geocoder.geocode({
                'location': latlong
            }, function (results, status) {
                if (status === 'OK') {
                    if (results[1]) {
                        map.setZoom(15);
                        var marker = new google.maps.Marker({
                            position: latlong,
                            map: map
                        });
                        markersArray.push(marker);
                        infowindow.setContent(results[1].formatted_address);
                        infowindow.open(map, marker);
                        document.getElementById("mapSearch").value = (results[1].formatted_address);
                    }
                }
            });
        }

    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuaq7NJkSDoz9ORGZzVopdHK6X-m8F6qs&libraries=places"></script>
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
                $(".remove").click(function(){
                    $(this).parent(".pip").remove();
                });
            
            }
            reader.readAsDataURL(f);
        }
    }

    }</script> @endpush