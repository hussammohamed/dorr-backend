<template>
  <div class="filter-map">
    <div class="filter-map__item">
   
    <!-- filter-map__selected -->
    <button v-for="filter in filters" class="mdl-button mdl-js-button mdl-js-ripple-effect filter-map__button ">
        {{filter.name_ar}}
    </button>
   
   </div>
</div>
</template>


<script>
export default {
     props: ["filtersmenus"],
     data(){
        return {
            filters: [],
        }
     },
        mounted() {
            this.filters =  this.filtersmenus.map(function(obj) {
                         obj.active = false;
                         return obj;
                });
        }
    };
</script>
