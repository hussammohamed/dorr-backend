function initMap() {
    var uluru = {lat: 23.885942, lng: 45.079162};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 6,
      center: uluru,
      disableDefaultUI: true
    });
    var marker = new google.maps.Marker({
      position: uluru,
      map: map,
      zoom: 15
    });
    google.maps.event.addListener(marker, 'click', function() {
        map.panTo(this.getPosition());
        map.setZoom(15);
        });  
  }