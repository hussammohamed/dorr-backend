<template>
  <div class="filter-map owl-theme">
    <button v-for="filter in filters" @click="filterFun(filter)"  class="item mdl-button mdl-js-button mdl-js-ripple-effect filter-map__button " :class="[filter.active ? 'filter-map__selected' : '']"> 
        {{filter.name_ar}}
    </button>
   

</div>
</template>


<script>
export default {
  props: ["filtersmenus"],
  FormData: {},
  data() {
    return {
      filters: [],
      filterItems: []
    };
  },
  methods: {
    filterFun: function(item) {
      this.filters.map(function(obj) {
        obj.active = false;
      });
      item.active = true;
      if (
        this.$parent.$children[2].$vnode.componentOptions.tag ==
        "properties-component"
      ) {
        this.$parent.$children[2].filterMethod.purpose = item.purpose;
        this.$parent.$children[2].filterMethod.type = item.type;
      }
      if (
        this.$parent.$children[1].$vnode.componentOptions.tag == "map-component"
      ) {
        this.$parent.$children[1].filterMethod.purpose = item.purpose;
        this.$parent.$children[1].filterMethod.type = item.type;
      }
    }
  },
  mounted() {
    this.filters = this.filtersmenus.map(function(obj) {
      obj.active = false;
      return obj;
    });
    let all = {
      active: true,
      id: 0,
      name_ar: "الكل",
      purpose: null,
      type: null
    };
    this.filters.unshift(all);
  }
};
</script>
