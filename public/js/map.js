var regions = [
    {
        "id": 1,
        "title": "الرياض",
        "location": {
            "lat": "24.713481",
            "long": "46.6752"
        }
    },
    {
        "id": 2,
        "title": "المدينة",
        "location": {
            "lat": "24.523575",
            "long": "39.568892"
        }
    },
    {
        "id": 3,
        "title": "مكة",
        "location": {
            "lat": "21.388093",
            "long": "39.858227"
        }
    },
]
var districts = [
    {
        "id": 1,
        "title": "الخرج",
        "regionID": 1,
        "location": {
            "lat": "24.145537",
            "long": "47.311945"
        }
    },
    {
        "id": 2,
        "title": "الدوادمي",
        "location": {
            "lat": "24.516700",
            "long": "44.418179"
        }
    }
]
var properties = [
    {
        "id": 1,
        "title": "فيلا للبيع في حي الراشدية",
        "purpose": "rent",
        "owner": {
            "id": 123,
            "name": "test owner",
            "phone": 123456
        },
        "region": {},
        "district": {},
        "location": {
            "lat": "24.516001",
            "long": "44.416233"
        },
        "details": {
            "type": "apartment",
            "description": "الراشدية ,مكة الكرمة",
            "price": '290,000',
            "pricePerMeter": 250,
            "dateOfPublication": "",
            "dateOfConstruction": "",
            "area": 405,
            "advertiserType": "",
            "level": 4,
            "finishType": "",
            "bathrooms": 2,
            "rooms": 5, 
            "picture": "http://localhost:8000/images/card1.png"
        },
        "pictures": [
            "path"
        ],
        "offers": [
            {
                "offerID": 1,
                "description": "beautiful",
                "price": 20000,
                "offerOwner": {
                    "phone": "123",
                    "name": "test offer",
                    "id": "1"
                }
            }
        ],
        "relativeProperties": []
    }
]
function removerMarkers(overlayArr) {
    $('.map-marker,.property-card').fadeOut().remove();
    
}
function initMap() {
    var uluru = new google.maps.LatLng(23.128363, 37.199707);
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 6,
        center: uluru,
        disableDefaultUI: true
    });
    regions.forEach(function (el) {
        var overlay = new CustomMarker(new google.maps.LatLng(el.location.lat, el.location.long), map, el, 'region');
    });
    map.addListener('zoom_changed', function () {
        let zoom = map.getZoom();
        let center = map.getCenter().lat();
        removerMarkers();
        console.log(zoom)
        if (zoom < 7) {
            regions.forEach(function (el) {
                var overlay = new CustomMarker(new google.maps.LatLng(el.location.lat, el.location.long), map, el, 'region');
            });
        }
        if (zoom >= 7 && zoom < 12) {
            districts.forEach(function (el) {
                var overlay = new CustomMarker(new google.maps.LatLng(el.location.lat, el.location.long), map, el, 'district');
            });
        }
        else if (zoom >= 12) {
            properties.forEach(function (el) {
                var overlay = new CustomMarker(new google.maps.LatLng(el.location.lat, el.location.long), map, el, 'property');
            });
        }

    });
   
    map.addListener('click', function () {
        $('.property-card').fadeOut().remove();
        $('.marker-hidden').removeClass('marker-hidden');
    });
    map.addListener('center_changed', function () {
        $('.property-card').fadeOut().remove();
        $('.marker-hidden').removeClass('marker-hidden');
    });
}
google.maps.event.addDomListener(window, 'load', initMap);


//search area
var mapConainer = $('#mapConainer');
var searchArea = $('#searchArea');
var searchBtn = $('#searchBtn');
var hideMap = $('#hideMap');
searchBtn.click(function () {
    mapConainer.toggleClass('no-search');
});
hideMap.click(function () {
    mapConainer.toggleClass('no-map');
});



