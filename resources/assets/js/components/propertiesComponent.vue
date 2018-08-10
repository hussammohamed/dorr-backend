<template>
  <div>
    <div class="content">
      <div class="sort-container">
        <ul class="sort-list">
          <li class="sort-item sort-item__title"> ترتيب حسب | </li>
          <li class="sort-item" :class="[sortItem.active ? 'active' : '']" v-for="sortItem in sortItems" @click="reSorting(sortItem)">
            {{sortItem.title}}
          </li>
        </ul>
      </div>
      <div class="grid">
        <div class="mdl-cell mdl-cell--12-col" v-for="property in filteredSorted(properties)">
          <div class="card horizontal mdl-card mdl-shadow--2dp h-card ">
            <a :href="['/properties/show/' + property.id]" class="card-link"></a>
            <div class="card-image">
              <div v-if="property.details.featured === 1" class="featured">
                <i class="material-icons">star</i>
              </div>
              <img v-if="property.pictures[0]" :src="property.pictures[0].path" data-echo="/images/card1.png"  alt="">
              <img v-else src="/images/card1.png" alt="">
            </div>
            <div class="card-stacked">
              <div class="card-content">
                <h5 class="card--title">{{property.title}}</h5>
                <h6 class="card--sub-title">{{property.details.address}}</h6>
                <p class="card--text">{{property.details.description}}</p>

                <span class="card--text__size">{{property.details.area}} م
                  <sup>2</sup>
                </span>
              </div>
              <div class="card-footer">
                <div class="card-footer__price">
                  <span class="price--text" v-text="addCommas(property.details.price, ' ريال')">
                    {{}}ريال
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
        regions: [],
        districts: [],
        map: {}
      };
    },
    methods: {
      addCommas(num, begText, endText) {
        num += '';
        var x = num.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
          x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        if (begText && endText) {
          return begText + x1 + x2 + endText;
        }
        else if (begText) {
          return x1 + x2 + begText;
        } else {
          return x1 + x2;
        }

      },
      filteredSorted: function (arr) {
        var self = this;
        //filter data
        arr = arr.filter(function (record) {
          if (self.filterMethod.purpose && self.filterMethod.type) {
            return (
              record.details.type.id == self.filterMethod.type &&
              record.purpose.id == self.filterMethod.purpose
            );
          } else {
            return record;
          }
        });

        var sortItem = this.sortItems.find(function (record) {
          return record.active == true;
        });
        switch (sortItem.id) {
          case 1:
            arr = arr.slice().sort(function (a, b) {
              return b.details.featured - a.details.featured;
            });
            break;
          case 2:
            arr = arr.slice().sort(function (a, b) {
              return a.id - b.id;
            });
            break;
          case 3:
            arr = arr.slice().sort(function (a, b) {
              return a.details.price - b.details.price;
            });
            break;
          case 4:
            arr = arr.slice().sort(function (a, b) {
              return b.details.price - a.details.price;
            });
            break;
        }

        //map
        if (self.map.zoom) {
          $.get("/api/v1/regions", function (data) {
            data.data.forEach(function (el) {
              var overlay = new CustomMarker(
                new google.maps.LatLng(el.location.lat, el.location.long),
                self.map,
                el,
                "region",
                self
              );
            });
            $(".map-marker,.property-card")
              .fadeOut()
              .remove();
          });
        }
        //return data
        return arr;
      },
      reSorting: function (item) {
        this.sortItems.map(function (obj) {
          obj.active = false;
        });
        item.active = true;
      },
    },

    mounted() {
     
      this.properties = this.$parent.$children[1].properties.slice().sort(function (a, b) {
        return b.details.featured - a.details.featured;
      });
    },

    updated() {
    }
  };
</script>