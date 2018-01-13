
function removerMarkers(overlayArr) {
    $('.map-marker,.property-card').fadeOut().remove();
    
}
function initMap() {
    var uluru = new google.maps.LatLng(23.128363, 37.199707);
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 6,
        center: uluru,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: true
    });
    $.get('/api/v1/regions', function (data) {
        data.data.forEach(function (el) {
            var overlay = new CustomMarker(new google.maps.LatLng(el.location.lat, el.location.long), map, el, 'region');
        });
      
    }) 
    
    map.addListener('zoom_changed', function () {
        let zoom = map.getZoom();
        let center = map.getCenter().lat();
        let url;
        removerMarkers();
  
        if (zoom < 7) {
            $.get('/api/v1/regions', function (data) {
                console.log(data)
                data.data.forEach(function (el) {
                    var overlay = new CustomMarker(new google.maps.LatLng(el.location.lat, el.location.long), map, el, 'region');
                });
              
            }) 
        }
        if (zoom >= 7 && zoom < 12) {
            
            // $.get('/api/v1/regions/districts', function (data) {
            //     console.log(data)
            //     data.forEach(function (el) {
            //         var overlay = new CustomMarker(new google.maps.LatLng(el.location.lat, el.location.long), map, el, 'region');
            //     });
              
            // }) 
        }
        else if (zoom >= 12) {
            // properties.forEach(function (el) {
            //     var overlay = new CustomMarker(new google.maps.LatLng(el.location.lat, el.location.long), map, el, 'property');
            // });
        }

    });
   
    map.addListener('click', function () {
        // $('.property-card').fadeOut().remove();
        $('.marker-hidden').removeClass('marker-hidden');
    });
    map.addListener('center_changed', function () {
        // $('.property-card').fadeOut().remove();
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



