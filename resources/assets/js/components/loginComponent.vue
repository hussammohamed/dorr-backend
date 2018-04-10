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
        <div :class="[errors.email ? errorClass : 'is-focused']" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label u-full-width">

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
          <a   @click="forgotPassword" class=" u-full-width u-no-padding mdl-button u-mtop16 u-center">هل نسيت كلمة المرور ؟</a>
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
      errorClass: "is-invalid is-dirty",
      errors: {}
    };
  },
  methods: {
    getDomainName: function(){
       var hostname;
        //find & remove protocol (http, ftp, etc.) and get hostname
        debugger
        if (location.host.indexOf("://") > -1) {
            hostname = location.host.split('/')[2];
        }
        else {
            hostname = location.host.split('/')[0];
        }
    
        //find & remove port number
        hostname = hostname.split(':')[0];
        //find & remove "?"
        hostname = hostname.split('?')[0];
          if(hostname.split(".").length> 2) {
            hostname = hostname.split(".")["1"] + "." + hostname.split(".")["2"]
            }
        return hostname;
    },
    saveSession: function(data){
      let domainName = this.getDomainName();
      document.cookie = 'userId='+ data.id +'; domain='+ domainName +'';
      document.cookie = 'token='+ data.api_token +'; domain='+ domainName +'';
    },
    forgotPassword: function () {
      this.$root.forgoPasswordDialog();
    },
    signupDialog: function(url) {
      this.$root.signupDialog();
    },
    closeDialog: function() {
      this.errors = {};
      this.$root.closeDialog(this.$el);
    },
    submit: function() {
      var self = this;
      var form = $("#loginForm");
      form.validate({
        rules: {
          email: {
            minlength: 3,
            required: true
          },
          password: {
            minlength: 8,
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
            url: "/api/v1/users/login",
            type: "post",
            data: form.serialize(),
            dataType: "json",
            success: function(_response) {
              self.saveSession(_response)
              if (self.$parent.url.length) {
                location.pathname = self.$parent.url;
              } else {
                location.reload();
              }
            },
            complete: function(_response) {
            },
            error: function(_response) {
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

  mounted() {}
};
</script>