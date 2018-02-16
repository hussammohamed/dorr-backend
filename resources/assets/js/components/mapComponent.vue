<template>
   <div id="mapConainer" class="map-container no-search">

<div id="map" class="map">
 
</div>
<button id="hideMap" class="mdl-button hide-map-btn mdl-js-button mdl-js-ripple-effect mdl-button--raised ">
  <i class="material-icons">map</i>
  إخفاء الخريطة
</button>
<div id="searchArea" class="map-serach mdl-card mdl-shadow--2dp">
<form  class="search-form" action="/properties/search" method="POST">
  <div class="serach-textfield">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--slim">
      <input v-model="FormData.keyword" class="mdl-textfield__input" name="keyword" type="text" id="mapSearch">
      <label class="mdl-textfield__label" for="mapSerach">بحث</label>
      <i class="material-icons u-flip search-icon">search</i>
    </div>
  </div>
  <div class="collapse-btn" id="searchBtn">
    <i class="material-icons"></i>
  </div>
<div class="mdl-grid ">
  <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select__region getmdl-select getmdl-select__fix-height">

      <input id="city" class="mdl-textfield__input regions" required  type="text" value="" readonly tabIndex="-1">
      <input  type="hidden" class="hidden-input"  name="city" required  value="" >
      <label for="city">


        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
      </label>
      <label for="city" class="mdl-textfield__label">المدينة</label>
      <ul for="city" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
        <li  v-for="region in regions" v-text="region.name_ar" tabindex="-1"  class="mdl-menu__item" :data-val="region.id"></li>
     
      </ul>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label  getmdl-select__city  getmdl-select getmdl-select__fix-height">
      <input class="mdl-textfield__input" type="text" id="district" value="" readonly tabIndex="-1">
      <input  type="hidden" name="district"  value="" >
      <label for="district">

        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
      </label>
      <label for="district" class="mdl-textfield__label">الحي</label>
      <ul for="district" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
        <li  v-for="district in districts" v-text="district.title" tabindex="-1" class="mdl-menu__item" :data-val="district.id"></li>
      </ul>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
      <input v-model="FormData.priceFrom" class="mdl-textfield__input" name="priceFrom" type="text" id="lowPrice">
      <label class="mdl-textfield__label" for="lowPrice">أقل سعر</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
      <input  v-model="FormData.priceTo" class="mdl-textfield__input" name="priceTo" type="text" id="hPrice">
      <label class="mdl-textfield__label" for="hPrice">أعلى سعر</label>
    </div>
  </div>
  <button type="submit" @click="propertySearch" class="mdl-button u-full-width  mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">
    بحث
  </button>
</div>
</form>
</div>


<form action="/properties/search" method="POST">
<div class="mdl-grid search-area--s">
  <div class="mdl-cell mdl-cell--2-col">
    <div class="mdl-textfield mdl-js-textfield ">
      <input v-model="FormData.keyword" class="mdl-textfield__input" name="keyword" type="text" id="mapSearch2">
      <label class="mdl-textfield__label" for="mapSerach2">بحث</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--2-col">
    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width   mdl-textfield--floating-label  getmdl-select getmdl-select__fix-height">
      <input class="mdl-textfield__input  regions" type="text" id="city2" value="" readonly tabIndex="-1">
      <input  type="hidden" class="hidden-input"  value=""  name="city">
      <label for="city2">
        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
      </label>
      <label for="city2" class="mdl-textfield__label">المدينة </label>
      <ul for="city2" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
 
        <li  v-for="region in regions" v-text="region.name_ar" tabindex="-1"  class="mdl-menu__item" :data-val="region.id"></li>
      </ul>
    </div>
  </div>
  
  <div class="mdl-cell mdl-cell--2-col">
    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select__city getmdl-select getmdl-select__fix-height">
      <input class="mdl-textfield__input" type="text" id="sample13" value="" readonly tabIndex="-1">
      <input  type="hidden"  value="" >
      <label for="sample13">
        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
      </label>
      <label for="sample13" class="mdl-textfield__label">الحي</label>
      <ul for="sample13" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
      <li  v-for="district in districts" v-text="district.title" tabindex="-1" class="mdl-menu__item" :data-val="district.id"></li>
      </ul>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--2-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
      <input v-model="FormData.priceFrom" class="mdl-textfield__input" name="priceFrom" type="text" id="lowPrice2">
      <label class="mdl-textfield__label" for="lowPrice2">أقل سعر</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--2-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
      <input  v-model="FormData.priceTo" class="mdl-textfield__input" name="priceTo"  type="text" id="hPrice2">
      <label class="mdl-textfield__label" for="hPrice2">أعلى سعر</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--2-col">
      <button id=""  @click="propertySearch(this)" class="mdl-button u-full-width mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">
          بحث
        </button>    
  </div>
  
</div>
</form>
</div>
</template>

<script>
export default {
  props: ["form", "cities", "uproperties"],
  data() {
    return {
      map: {},
      FormData: {},
      regions: [],
      districts: [],
      citiesGet: [],
      properties: [],
      kind: null,
      bound: true,
      filterMethod: {
        purpose: null,
        type: null
      }
    };
  },
  watch: {
    filterMethod: {
      handler: function(val, oldVal) {
        this.filterMap();
      },
      deep: true
    },
    kind: {
      handler: function(val, oldVal) {
        console.log(this.kind);
        this.filterMap();
      }
    }
  },
  methods: {
    filterMap() {
      var self = this;
      var bounds = new google.maps.LatLngBounds();
      $(".map-marker,.property-card")
        .fadeOut()
        .remove();
      switch (self.kind) {
        case "properties":
          let arr = self.properties.filter(function(record) {
            if (self.filterMethod.purpose && self.filterMethod.type) {
              return (
                record.details.type.id == self.filterMethod.type &&
                record.purpose.id == self.filterMethod.purpose
              );
            } else {
              return record;
            }
          });
          arr.forEach(function(el) {
            var overlay = new CustomMarker(
              new google.maps.LatLng(el.location.lat, el.location.long),
              self.map,
              el,
              "property"
            );
            bounds.extend(overlay.getPosition());
          });
          if (self.bound && arr.length) {
            self.map.fitBounds(bounds);
            setTimeout(() => {
              if(self.map.zoom > 15){
                 self.map.setZoom(15);
              }else if (self.map.zoom < 11){
                self.map.setZoom(11);
              }
             
            }, 150);
          }
          if (
            self.$parent.$children[2].$vnode.componentOptions.tag ==
            "properties-component"
          ) {
            self.$parent.$children[2].properties = self.properties;
          }
          break;
        case "regions":
          $.get("/api/v1/regions/", function(data) {
            data.data.forEach(function(el) {
              var overlay = new CustomMarker(
                new google.maps.LatLng(el.location.lat, el.location.long),
                self.map,
                el,
                "region",
                self
              );
            });
          });
          break;
        case "cities":
            $.get(
              "/api/v1/regions/" +
                self.map.getCenter().lat() +
                "/" +
                self.map.getCenter().lng() +
                "",
              function(data) {
                console.log(data)
                self.citiesGet = data.data;
                data.data.forEach(function(el) {
                  var overlay = new CustomMarker(
                    new google.maps.LatLng(el.location.lat, el.location.long),
                    self.map,
                    el,
                    "district",
                    self
                  );
                });
              }
            );
         
          break;
      }
    },
    propertySearch: function() {
      var self = this;
      var form = $(event.target).parents('form');
      form.submit(function(event) {
        if(location.pathname == "/properties/search"){
        //event.preventDefault();
        }
        $.ajax({
          url: "/api/v1/properties/search",
          type: "post",
          data: form.serialize(),
          dataType: "json",
          success: function(_response) {
            self.properties = _response.data;
            self.bound = true;
            if (self.kind != "properties") {
              self.kind = "properties";
            } else {
              self.filterMap();
            }
          },
          complete: function(_response) {},
          error: function(_response) {}
        });
      });
    }
  },

  mounted() {
    //map
    var self = this;
    function removerMarkers(overlayArr) {
      $(".map-marker,.property-card")
        .fadeOut()
        .remove();
    }
    function initMap() {
      var uluru = new google.maps.LatLng(23.128363, 37.199707);
      var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 5,
        center: uluru,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: true
      });
      self.map = map;
      self.kind = "properties";
      map.addListener("zoom_changed", function() {
        let center = map.getCenter().lat();
        let zoom = map.getZoom();
        if (zoom < 7) {
          self.kind = "regions";
        }
        if (zoom >= 7 && zoom <= 10) {
          if (self.kind != "cities") {
            self.kind = "cities";
          } else {
            self.filterMap();
          }
        } else if (zoom > 10) {
            
        }
      });

      map.addListener("click", function() {
        $(".property-card")
          .fadeOut()
          .remove();
        $(".marker-hidden").removeClass("marker-hidden");
      });
      map.addListener("dragend", function() {
        self.bound = false;
        let zoom = map.getZoom();
        if (zoom >= 7 && zoom <= 10) {
          if (self.kind != "cities") {
            self.kind = "cities";
          } else {
            self.filterMap();
          }
        } else if (zoom > 10) {
          $.ajax({
            url:
              "/api/v1/properties/search?lat=" +
              map.getCenter().lat() +
              "&long=" +
              map.getCenter().lng() +
              "",
            type: "post",
            dataType: "json",
            success: function(_response) {
              $(".map-marker,.property-card")
                .fadeOut()
                .remove();
              self.properties = _response.data;
              if (self.kind != "properties") {
                self.kind = "properties";
              } else {
                self.filterMap();
              }
            }
          });
        }
      });
      map.addListener("center_changed", function() {
        $(".property-card")
          .fadeOut()
          .remove();
        $(".marker-hidden").removeClass("marker-hidden");
      });
       if(location.pathname != "/properties/search"){
      self.kind = "regions";
       }
    }

    google.maps.event.addDomListener(window, "load", initMap);

    //setData
    this.regions = this.cities;
    if(location.pathname == "/properties/search"){
      $("#mapConainer").removeClass("no-search");
    this.FormData = this.form;
    this.properties = this.uproperties.slice().sort(function(a, b) {
      return b.details.featured - a.details.featured;
    });
    }
         
  
    //search area
    var mapConainer = $("#mapConainer");
    var searchArea = $("#searchArea");
    var searchBtn = $("#searchBtn");
    var hideMap = $("#hideMap");
    var searchInput =  $("#mapSearch");
    if(localStorage.getItem('noMap') === "true"){
       mapConainer.addClass("no-map");
    }else{
       mapConainer.removeClass("no-map");
    }
    searchBtn.click(function() {
      mapConainer.toggleClass("no-search");
    });
    searchInput.click(function() {
      mapConainer.removeClass("no-search");
    });
    hideMap.click(function() {
      if(localStorage.getItem('noMap') === "true"){
        localStorage.setItem('noMap', false);
      }else{
         localStorage.setItem('noMap', true);
      }
      mapConainer.toggleClass("no-map");
    });
  },

  updated() {
    var self = this;
    if (this.FormData.city) {
      $("[data-val=" + this.FormData.city + "]").attr("data-selected", "true");
    }

    setTimeout(() => {
      $(".regions").each(function(){
        $(this).change(function() {
        var value = $(this).parent().find(".hidden-input").val();
        $.ajax({
          url: "/api/v1/regions/" + value + "",
          type: "GET",
          success: function(_response) {
            self.districts = _response.data;
          },
          complete: function(_response) {
            setTimeout(() => {
              if (self.FormData.district) {
                $("[data-val=" + self.FormData.district + "]").attr(
                  "data-selected",
                  "true"
                );
              }
              getmdlSelect.init(".getmdl-select__city");
            }, 10);
          }
        });
      });
    }, 50);
  });
  }
};
</script>
