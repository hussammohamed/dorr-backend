<template>



<div>
    <div id="mapConainer" class="map-container no-search">

<div id="map" class="map">
 
</div>
<button id="hideMap" class="mdl-button hide-map-btn mdl-js-button mdl-js-ripple-effect mdl-button--raised ">
  <i class="material-icons">map</i>
  إخفاء الخريطة
</button>
<div id="searchArea" class="map-serach mdl-card mdl-shadow--2dp">
<form  class="search-form">
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
    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">

      <input id="city" class="mdl-textfield__input regions"  type="text" value="" readonly tabIndex="-1">
      <input  type="hidden" class="hidden-input"  name="city"  value="" >
      <label for="city">


        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
      </label>
      <label for="city" class="mdl-textfield__label">المدينة</label>
      <ul for="city" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
          <li   tabindex="-1"  class="mdl-menu__item" data-val="-1">الكل</li>
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
      <input class="mdl-textfield__input" name="keyword" type="text" id="mapSearch2">
      <label class="mdl-textfield__label" for="mapSerach2">بحث</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--2-col">
    <div class="mdl-textfield mdl-js-textfield getmdl-select__fullwidth u-full-width  mdl-textfield--floating-label  getmdl-select getmdl-select__fix-height">
      <input class="mdl-textfield__input  city_id_js" type="text" id="city2" value="" readonly tabIndex="-1">
      <input  type="hidden" class="hidden-input"  value=""  name="city">
      <label for="city2">
        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
      </label>
      <label for="city2" class="mdl-textfield__label">المدينة </label>
      <ul for="city2" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
 
      <li class="mdl-menu__item" data-val=""></li>
     
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
      <!-- <li  v-for="city in cities" v-text="city.title" tabindex="-1" class="mdl-menu__item" :data-val="city.id"></li> -->
      </ul>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--2-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
      <input class="mdl-textfield__input" name="priceFrom" type="text" id="lowPrice2">
      <label class="mdl-textfield__label" for="lowPrice2">أقل سعر</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--2-col">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
      <input class="mdl-textfield__input" name="priceTo"  type="text" id="hPrice2">
      <label class="mdl-textfield__label" for="hPrice2">أعلى سعر</label>
    </div>
  </div>
  <div class="mdl-cell mdl-cell--2-col">
      <button id="" class="mdl-button u-full-width mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">
          بحث
        </button>    
  </div>
  
</div>
</form>
</div>
 <div class="content">
    <div class="sort-container">
    <ul class="sort-list">
        <li class="sort-item sort-item__title"> ترتيب حسب | </li>
        <li class="sort-item" :class="[sortItem.active ? 'active' : '']"  v-for="sortItem in sortItems" @click="reSorting(sortItem)">
            {{sortItem.title}}
            </li>
    </ul>
</div>
 <div class="grid">
  <div class="mdl-cell mdl-cell--12-col" v-for="property in filteredSorted(properties)">
    <div class="card horizontal mdl-card mdl-shadow--2dp h-card " >
    <a :href="['/properties/show/' + property.id]" class="card-link"></a>
        <div class="card-image">
          <div v-if="property.details.featured === 1" class="featured" >
          <i class="material-icons">star</i>
          </div>
        <img v-if="property.pictures[0]" :src="property.pictures[0].path" alt="">
        <img v-else src="/images/card1.png" alt="">
        </div>
        <div class="card-stacked">
            <div class="card-content">
                <h5 class="card--title">{{property.title}}</h5>
                <h6 class="card--sub-title">{{property.details.address}}</h6>
                <p class="card--text">{{property.details.description}}</p>
                
                    <span class="card--text__size">{{property.details.area}}  م
                        <sup>2</sup>
                    </span>
            </div>
            <div class="card-footer">
                <div class="card-footer__price">
                    <span class="price--text">
                      {{property.details.price}}ريال
                    </span>
                </div>
                <div class="footer-contet">
                    <span>{{property.details.bathrooms}}</span>
                    <img src="/images/bathroom.svg" alt="">
                    <span>{{property.details.rooms}}</span>
                    <i class="material-icons md-18">local_hotel</i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</template>
<script>
export default {
  props: ["uproperties", "form", "cities"],
  data() {
    return {
      filterMethod: {
        purpose: null,
        type: null
      },
      properties: [],
      sortItems: [
        {
          id: 1,
          title: "التميز",
          method: "details.featured",
          active: true
        },
        {
          id: 2,
          title: "الأحدث",
          method: "id",
          active: false
        },
        {
          id: 3,
          title: "الأقل سعرا",
          method: "details.price",
          active: false
        },
        {
          id: 4,
          title: "الأعلى سعرا",
          method: "details.price",
          active: false
        }
      ],
      FormData: {},
      regions: [],
      districts: [],
      map: {}
    };
  },
  methods: {
    filteredSorted: function(arr) {
      var self = this;
      //filter data
       debugger
        arr = arr.filter(function(record) {
        if (self.filterMethod.purpose && self.filterMethod.type) {
          return (
            record.details.type == self.filterMethod.type &&
            record.details.purpose == self.filterMethod.purpose
          );
        } else {
          return record;
        }
      });

      var sortItem = this.sortItems.find(function(record) {
        return record.active == true;
      });
      switch (sortItem.id) {
        case 1:
          arr = arr.slice().sort(function(a, b) {
            return b.details.featured - a.details.featured;
          });
          break;
        case 2:
          arr = arr.slice().sort(function(a, b) {
            return a.id - b.id;
          });
          break;
        case 3:
          arr = arr.slice().sort(function(a, b) {
            return a.details.price - b.details.price;
          });
          break;
        case 4:
          arr = arr.slice().sort(function(a, b) {
            return b.details.price - a.details.price;
          });
          break;
      }
      return arr;
    },
    reSorting: function(item) {
      this.sortItems.map(function(obj) {
        obj.active = false;
      });
      item.active = true;
      console.log()
      this.properties = this.filteredSorted(this.properties);
    },

    propertySearch: function() {
      var self = this;
      $(".search-form").submit(function(event) {
        event.preventDefault();
        $.ajax({
          url: "/api/v1/properties/search",
          type: "post",
          data: $(".search-form").serialize(),
          dataType: "json",
          success: function(_response) {
            self.properties = _response.data;
            $(".map-marker,.property-card")
              .fadeOut()
              .remove();

            var bounds = new google.maps.LatLngBounds();
            _response.data.forEach(function(el) {
              var overlay = new CustomMarker(
                new google.maps.LatLng(el.location.lat, el.location.long),
                self.map,
                el,
                "property"
              );
              bounds.extend(overlay.getPosition());
            });
            self.map.fitBounds(bounds);
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
        zoom: 6,
        center: uluru,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: true
      });
      self.map = map;
      var bounds = new google.maps.LatLngBounds();
      self.properties.forEach(function(el) {
        var overlay = new CustomMarker(
          new google.maps.LatLng(el.location.lat, el.location.long),
          self.map,
          el,
          "property"
        );
        bounds.extend(overlay.getPosition());
      });
      self.map.fitBounds(bounds);

      map.addListener("zoom_changed", function() {
        let zoom = map.getZoom();
        let center = map.getCenter().lat();
        let url;

        if (zoom < 7) {
          $.get("/api/v1/regions", function(data) {
            data.data.forEach(function(el) {
              var overlay = new CustomMarker( new google.maps.LatLng(el.location.lat, el.location.long), map, el, "region", self);
            });
          });

          removerMarkers();
        }
        if (zoom >= 7 && zoom < 11) {
          
        } else if (zoom >= 12) {
        }
      });

      map.addListener("click", function() {
        $(".property-card")
          .fadeOut()
          .remove();
        $(".marker-hidden").removeClass("marker-hidden");
      });
      map.addListener("center_changed", function() {
        $(".property-card")
          .fadeOut()
          .remove();
        $(".marker-hidden").removeClass("marker-hidden");
      });
    }
    google.maps.event.addDomListener(window, "load", initMap);

    //search area
    var mapConainer = $("#mapConainer");
    var searchArea = $("#searchArea");
    var searchBtn = $("#searchBtn");
    var hideMap = $("#hideMap");
    searchBtn.click(function() {
      mapConainer.toggleClass("no-search");
    });
    hideMap.click(function() {
      mapConainer.toggleClass("no-map");
    });

    //setData
    this.regions = this.cities;
    this.FormData = this.form;
    this.properties = this.uproperties.slice().sort(function(a, b) {
      return b.details.featured - a.details.featured;
    });
  },

  updated() {
    var self = this;
    if (this.FormData.city) {
      $("[data-val=" + this.FormData.city + "]").attr("data-selected", "true");
    }

    setTimeout(() => {
      $(".regions").change(function() {
        var value = $(this)
          .parent()
          .find(".hidden-input")
          .val();
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
  }
};
</script>