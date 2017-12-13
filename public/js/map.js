function initMap() {
    var uluru = new google.maps.LatLng(23.885942, 45.079162);
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 6,
      center: uluru,
    });
    // var marker = new google.maps.Marker({
    //   position: uluru,
    //   map: map,
    //   zoom: 15
    // });
    var overlay = new CustomMarker(uluru, map, {"id": 30, "name": "الرياض"});
    // google.maps.event.addListener(marker, 'click', function() {
    //     map.panTo(this.getPosition());
    //     map.setZoom(15);
    //     });  
  }
  google.maps.event.addDomListener(window, 'load', initMap);
  