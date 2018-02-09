<template>
  <dialog class="mdl-dialog reportDialog dialog" @click="closeDialog" id="reportDialog">
    <form id="reportForm">
      <div class="mdl-dialog__content">
          <input v-model="propertyid" type="hidden" value="" name="property_id"/>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
          <textarea class="mdl-textfield__input" name="comment" type="text" rows="5" id="comment"></textarea>
          <label class="mdl-textfield__label" for="comment">تفاصيل البلاغ</label>

        </div>
      </div>
      <div class="mdl-dialog__actions">
        <button type="submit" @click="submit" class="mdl-button">حفظ</button>
        <button type="button" @click="cancelDialog" class="mdl-button close">ألغاء</button>
      </div>
    </form>
  </dialog>
</template>

<script>
  export default {
    data() {
      return {
        csrf: document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
        errorClass: "is-invalid is-dirty",
        errors: {}
      };
    },
    props: ["propertyid"],
    methods: {
      cancelDialog: function () {
        this.$el.close();
        this.errors = {};
      },
      closeDialog: function () {
        this.$root.closeDialog(this.$el);
      },
      submit: function () {
        var self = this;
        var form = $("#reportForm");
        form.validate({
          rules: {
            comment: {
              minlength: 10,
              required: true
            },
          },
          highlight: function (element) {
            $(element)
              .closest(".mdl-textfield")
              .addClass("is-invalid");
          },
          unhighlight: function (element) {
            $(element)
              .closest(".mdl-textfield")
              .removeClass("is-invalid");
          },
          errorElement: "span",
          errorClass: "mdl-textfield__error",
          errorPlacement: function (error, element) {

            error.insertAfter(element);
          }
        });
        if (form.valid()) {
          form.submit(function (event) {
            event.preventDefault();
            $.ajax({
              url: "/api/v1/property/reports/1/store",
              type: "post",
              data: form.serialize(),
              dataType: "json",
              success: function (_response) {
                self.$root.closeDialog(self.$el);
                self.$root.sucssesDialog();
              },
              complete: function (_response) { },
              error: function (_response) {
                //this.errors = JSON.parse(_response.responseText).errors
                self.errors = {
                  email: ["wrong credentials"]
                };
                // Handle error
              }
            });
          });
        }
      }
    },

    mounted() { }
  };
</script>