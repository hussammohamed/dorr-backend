

    var form = $("#properties-form");
    $( document ).ready(function() {
        $.validator.addMethod('moreThan', function (value, element, param) {
            if (this.optional(element)) return true;
            var i = parseInt(value);
            var j = parseInt($(param).val());
            if (isNaN(j)) return true;
            return i > j;
        }, "السعر يجب ان يكون اكبر من سعر السوم");
        form.validate({
            rules: {
                "checkbox[]": {
                    required: true,
                    minlength: 1
                },
                "price": {
                    moreThan: "#bid_price"
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
        //loadForm();
        
    });

    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "fade",
        onInit: function (event, currentIndex, newIndex) {
            var currentStep = form.children("div").steps("getStep", currentIndex);
            //window.location.hash = currentStep.title;
            
            $('.dropdown-mul-2').dropdown({
                limitCount: 5,
                searchable: false
            });
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            saveForm(form.children("div").steps("getStep", newIndex).title);
            $(".u-hidden").removeClass('u-hidden');
            if (form.valid() && $("#district").valid()) {
                $(".is-invalid").removeClass("is-invalid");
                if (currentIndex == 1 && !$("#long").val() && !$("#lat").val()) {
                    $('html,body').animate({
                        scrollTop: $("#map").offset().top - 50
                    },
                        500);
                    $(".valid-map").removeClass('hidden');

                    return false;
                } else {
                    $(".valid-map").addClass('hidden');
                    return true;
                }
            } else if (newIndex < currentIndex) {
                return true;
            }
            else {
                $("#district").valid()
                $(".is-invalid:first>input").focus();
                return false;
            }


        },
        onStepChanged: function (event, currentIndex, newIndex) {
            var currentStep = form.children("div").steps("getStep", currentIndex);
            window.location.hash = currentStep.title;
            initMap();
            $("html, body").animate({ scrollTop: 0 }, 800);
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
    $("#bid_price").bind('input', function () {
        if ($("#price").val()) {
            $("#price").valid();
        }
    })
  
    $(window).bind('hashchange', function (e) {

        getCorrectStep();
    });
    function getCorrectStep(){
        var $wizard = form.children("div");
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
    }
    function saveForm(currentIndex){

        var formSerialize =   JSON.stringify(form.serializeArray());
        document.cookie = "formSerialize=" + formSerialize + ";";
        document.cookie = "currentStep=" + currentIndex + ";";
    }
    function loadForm(){
        if(getCookie('formSerialize')){
            var formData = JSON.parse(getCookie('formSerialize'));
            window.location.hash = getCookie('currentStep');
            if(formData && formData.length){
                formData.forEach(element => {
                    let input = $("input[name='"+ element.name + "']");
                    if(input.hasClass("select-input__js")){
                        input.parent().find("li[data-val='1']").attr("data-selected", "true");
                        console.log(input.parent().find("li[data-val='1']"))
                    }
                    input.val(element.value);
                });
            }
            setTimeout(() => {
                getCorrectStep();
            }, 200); 
            setTimeout(() => {
             getmdlSelect.init('.getmdl-select');
            }, 100); 
   
           
            
            
        }
    }
    function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    }
    
    function initMap() {
        var uluru = new google.maps.LatLng(23.128363, 37.199707);
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: uluru,
            disableDefaultUI: true,
            zoomControl: true,
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
        if (purposeId == "2") {
            $(".target-sale").addClass('hidden');
            $(".target-rent").removeClass('hidden');
        } else {
            $(".target-rent").addClass('hidden');
            $(".target-sale").removeClass('hidden');
        }
    });
    $("#type").change(function () {
        var typeId = $("#typesContainer").find(".selected").attr("data-val");
        if (typeId == "2") {
            $(".target-apartment").addClass('hidden');
            $(".target-villa").removeClass('hidden');
        } else {
            $(".target-villa").addClass('hidden');
            $(".target-apartment").removeClass('hidden');
        }
    });

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

    }