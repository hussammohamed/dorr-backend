<template>
  <dialog class="mdl-dialog reportDialog dialog map-dialog" @click="closeDialog" id="mapDialog">
      <div class="mdl-dialog__content">
          <div id="mapView"  style="height:500px; width:100%;"></div>
      </div>
      <div class="mdl-dialog__actions">
        <button type="submit" @click="cancelDialog" class="mdl-button">غلق</button>
      </div>
  </dialog>
</template>

<script>
  export default {
    props: ["propertylat", "propertylong"],
    methods: {
      cancelDialog: function () {
        this.$el.close();
        this.errors = {};
      },
      closeDialog: function () {
        this.$root.closeDialog(this.$el);
      },
     
    },

    mounted() {
     
     }
  };
</script>