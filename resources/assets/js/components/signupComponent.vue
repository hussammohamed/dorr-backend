<template>
  <dialog class="mdl-dialog dialog" @click="closeDialog" id="signupDialog">
    <div class="mdl-diaglog__head">
      <div class="mdl-dialog__text">
        <h5>تسجيل حساب جديد</h5>
         <p>سجل حساب جديد فى تطبيق دور</p>
         <p>إذا كنت مسجل مسبقا قم بـ <a href="#" @click="loginDialog" >تسجيل دخول</a></p>
        </div>
      <div class="mdl-dialog__logo">
        <div class="bg"></div>
        <img src="/images/dorr-logo.svg" alt="Dorr">
      </div>
    </div>

    <div class="mdl-dialog__content">
      <form  id="signupForm">
   <input type="hidden" name="_token" :value="csrf">
    <div :class="[errors.name ? errorClass : '']" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
        <input class="mdl-textfield__input"  type="text" name="name"  id="signupName">
        <label class="mdl-textfield__label" for="signupName">أسم المستخدم</label>
        <span class="mdl-textfield__error"  v-for="name in errors.name" v-text="name"></span>
    </div>
    <div :class="[errors.email ? errorClass : '', 'is-dirty']" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
        <input class="mdl-textfield__input" type="email" name="email"  id="signupEmail">
        <label class="mdl-textfield__label" for="signupEmail">البريد الألكترونى</label>
        <span class="mdl-textfield__error"  v-for="email in errors.email" v-text="email"></span>
    </div>
    <div :class="[errors.password ? errorClass : '', 'is-dirty']" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
        <input class="mdl-textfield__input " type="password" name="password" id="signupPassword">

        <label class="mdl-textfield__label" for="signupPassword">كلمة المرور</label>
        <span class="mdl-textfield__error"  v-for="password in errors.password" v-text="password"></span>
    </div>
    <div :class="[errors.password ? errorClass : '', 'is-dirty']" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
        <input class="mdl-textfield__input " type="password" name="password_confirmation" id="signupPasswordConfirmation">
        <label class="mdl-textfield__label" for="signupPasswordConfirmation">تأكيد كلمة المرور</label>
        <span class="mdl-textfield__error"  v-for="password in errors.password" v-text="password"></span>
    </div>
    <div  :class="[errors.mobile1 ? errorClass : '', 'is-dirty']" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">

        <input class="mdl-textfield__input " type="number" name="mobile1" id="signupPhone">

        <label class="mdl-textfield__label" for="signupPhone">رقم الجوال</label>
        <span class="mdl-textfield__error"  v-for="mobile1 in errors.mobile1" v-text="mobile1"></span>
    </div>
    <div class="">
        <button @click="submit" class="mdl-button u-mtop16 u-full-width mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center">تسجيل</button>
    </div>
</form>
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
      errorClass: "is-invalid",
      errors: {}
    };
  },
  methods: {
    loginDialog: function(url) {
      this.$root.loginDialog();
    },
    closeDialog: function() {
      this.errors = {};
      this.$root.closeDialog(this.$el);
    },
    submit: function() {
      var self = this;
      var form = $("#signupForm");
      form.validate({
        rules: {
          name: {
            minlength: 3,
            required: true
          },
          email: {
            minlength: 3,
            required: true
          },
          password: {
            minlength: 8,
            required: true
          },
          password_confirmation: {
            equalTo: "#signupPassword",
            required: true
          },
          mobile1: {
            required: true
          }
        },
        highlight: function(element) {
          $(element)
            .closest(".mdl-textfield")
            .addClass("is-invalid");
        },
        unhighlight: function(element) {
          $(element)
            .closest(".mdl-textfield")
            .removeClass("is-invalid");
        },
        errorElement: "span",
        errorClass: "mdl-textfield__error",
        errorPlacement: function(error, element) {

            error.insertAfter(element);
        }
      });

      if (form.valid()) {
        form.submit(function(event) {
          event.preventDefault();
          $.ajax({
            url: "/register",
            type: "post",
            data: form.serialize(),
            dataType: "json",
            success: function() {
              location.reload();
            },
            complete: function(_response) {
              if (_response.status == 422) {
                self.errors = JSON.parse(_response.responseText).errors;
              } else {
                location.reload();
              }
            },
            error: function(_response) {
              // Handle error
            }
          });
        });
      }
    }
  },

  mounted() {}
};
</script>