<template>
  <dialog class="mdl-dialog reportDialog dialog" @click="closeDialog" id="successDialog">
      <div class="mdl-dialog__content u-center">
       <div class="card-title">
          تم رفع البلاغ وسيتم مراجعة الأعلان
      </div>
      <img class="pic" src="/images/checked.svg" alt="">
      </div>
      <div class="mdl-dialog__actions">
        <button type="submit" @click="cancelDialog" class="mdl-button">غلق</button>
      </div>
  </dialog>
</template>

<script>
  export default {
    methods: {
      cancelDialog: function () {
        this.$el.close();
        this.errors = {};
      },
      closeDialog: function () {
        this.$root.closeDialog(this.$el);
      },
     
    },

    mounted() { }
  };
</script>