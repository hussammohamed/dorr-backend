<template>
  <dialog class="mdl-dialog dialog custom"  id="forgotPasswordDialog">
     <div class="dialog__container">
    <div class="mdl-diaglog__head">
      <div class="mdl-dialog__text">
        <h5>إسترجاع كلمة المرور</h5>
        <p>برجاء إدخال البريد الألكتروني المسجل فى التطبيق</p>
        <p>سيتم إرسال رابط إسترجاع كلمة المرور علي البريد </p>
      </div>
      <div class="mdl-dialog__logo">
        <div class="bg"></div>
        <img src="/images/dorr-logo.svg" alt="Dorr">
      </div>
    </div>

    <div class="mdl-dialog__content">
      <form id="forgotPasswordform" method="POST" action="/password/email">
        <input type="hidden" name="_token" :value="csrf">
        <div class="form-container">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
            <input class="mdl-textfield__input" type="email" name="email"  required id="sendEmail">
            <label class="mdl-textfield__label" for="sendEmail">البريد الألكترونى</label>
          </div>
        </div>
        <div class="">
          <button :disabled="isLoading" type="submit"  class="mdl-button u-mtop16 u-full-width mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center">إرسال</button>
        </div>
      </form>
    </div>
    <div v-if="isLoading" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>
     </div>

  </dialog>
</template>

<script>
  export default {
    data() {
      return {
        csrf: document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
        errors: {},
        isLoading: false
      };
    },
    methods: {
      submit: function () {
        var self = this;
        var form = $("#forgotPasswordform");
        form.validate({
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
            self.isLoading = true;
            $.ajax({
              url: "/password/email",
              type: "post",
              data: form.serialize(),
              dataType: "json",
              success: function (_response) {
                console.log(_response)
                
              },
              complete: function (_response) { },
              error: function (_response) {
                //this.errors = JSON.parse(_response.responseText).errors
                self.errors = {
                  email: ["wrong credentials"]
                };
                self.isLoading = false;
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