<template>
  <dialog class="mdl-dialog dialog" @click="closeDialog" id="loginDialog">
    <div class="mdl-diaglog__head">
      <div class="mdl-dialog__text">
        <h5>تسجيل دخول</h5>
        <p>سجل حساب جديد فى تطبيق دور</p>
        <p>إذا كنت غير مسجل قم بـ
          <a href="#" @click="signupDialog">تسجيل حساب جديد</a>
        </p>
      </div>
      <div class="mdl-dialog__logo">
        <div class="bg"></div>
        <img src="/images/dorr-logo.svg" alt="Dorr">
      </div>
    </div>

    <div class="mdl-dialog__content">
      <form id="loginForm">
        <input type="hidden" name="_token" :value="csrf">
        <div :class="[errors.email ? errorClass : '']" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">

          <input class="mdl-textfield__input" type="text" name="email" id="email">
          <label class="mdl-textfield__label" for="email">البريد الألكترونى أو رقم الجوال</label>
          <span class="mdl-textfield__error"  v-for="email in errors.email" v-text="email"></span>
        </div>
        <div :class="[errors.email ? errorClass : '']" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">
          <input class="mdl-textfield__input " name="password" type="password" id="password">
          <label class="mdl-textfield__label" for="password">كلمة المرور</label>
         <span class="mdl-textfield__error"  v-for="email in errors.email" v-text="email"></span>
        </div>
        <div class="">

          <button type="submit" @click="submit" class="mdl-button u-mtop16 u-full-width mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center">دخول</button>
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
    signupDialog: function(url) {
      this.$root.signupDialog();
    },
    closeDialog: function() {
      this.errors = {};
      this.$root.closeDialog(this.$el);
    },
    submit: function() {
      var self = this;
      $("#loginForm").submit(function(event) {
        event.preventDefault();
        $.ajax({
          url: url + "api/v1/users/login/",
          type: "post",
          data: $("#loginForm").serialize(), 
          dataType: "json",
          success: function(_response) {
            if(self.$parent.url.length){
            location.pathname = self.$parent.url
            }
            else{
              location.reload();
            }
          },
          complete: function(_response) {
              
         
          },
          error: function(_response) {
            //this.errors = JSON.parse(_response.responseText).errors
            self.errors = {
              email:["wrong credentials"]
            }
            // Handle error
          }
        });
      });
    }
  },

  mounted() {}
};
</script>
