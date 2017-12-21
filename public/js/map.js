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
function removerMarkers(overlayArr){
    overlayArr.forEach(function(el){
        el.remove();
       
    });
}
function initMap() {
    var uluru = new google.maps.LatLng(23.128363, 37.199707);
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 6,
      center: uluru,
      disableDefaultUI: true
    });
   var overlayArr = [];
    regions.forEach(function(el) {
      var overlay = new CustomMarker(new google.maps.LatLng(el.location.lat, el.location.long), map, {"id": el.id, "name": el.title});
      overlayArr.push(overlay);
  }); 
  map.addListener('zoom_changed', function() {
    //console.log(map.getCenter().lat(), map.getZoom())
    removerMarkers(overlayArr);
    //console.log(overlayArr)
  }); 
  }
  google.maps.event.addDomListener(window, 'load', initMap);
  
 