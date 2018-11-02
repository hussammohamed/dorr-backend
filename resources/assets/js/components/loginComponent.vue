<template>
  <dialog class=" mdl-dialog dialog"  id="loginDialog">
    <div class="dialog__container">
    <div class="backdrop"></div>
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
        <div class="mdl-cell u-full-width">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="remember">
                            <input type="hidden" name="remember" value=false />
                            <input type="checkbox" id="remember" tabIndex="12" value=true name="remember" class="mdl-checkbox__input">
                            <span class="remember">تذكرني</span>
                        </label>
                    </div>
        <input class="mdl-textfield__input" type="hidden" name="username" id="username">
        <input class="mdl-textfield__input" type="hidden" name="client_id" value="2" >
        <input class="mdl-textfield__input" type="hidden" name="client_secret" value="Io39lW5eyWsE5y17tgqR9SipwZepjwEIGvkKv3Vu" >
        <input class="mdl-textfield__input" type="hidden" name="grant_type" value="password" >
        
        <div class="">
          <button type="submit" :disabled="isLoading" @click="submit" class="mdl-button u-mtop16 u-full-width mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored u-center">دخول</button>
          <a   @click="forgotPassword" class=" u-full-width u-no-padding mdl-button u-mtop16 u-center">هل نسيت كلمة المرور ؟</a>
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
      errorClass: "is-invalid is-dirty",
      errors: {},
      isLoading: false
    };
  },
  methods: {
    getDomainName: function() {
      var hostname;
      //find & remove protocol (http, ftp, etc.) and get hostname
      if (location.host.indexOf("://") > -1) {
        hostname = location.host.split("/")[2];
      } else {
        hostname = location.host.split("/")[0];
      }

      //find & remove port number
      hostname = hostname.split(":")[0];
      //find & remove "?"
      hostname = hostname.split("?")[0];
      if (hostname.split(".").length > 2) {
        hostname = hostname.split(".")["1"] + "." + hostname.split(".")["2"];
      }
      return hostname;
    },
    saveSession: function(data) {
      let domainName = this.getDomainName();
      if ($('#remember').is(':checked')) {
      let exp = (new Date()).getTime() + 60 * 24 * 60 * 60 * 1000;
      console.log(exp)  
      document.cookie =
        "token=" + data.token_type + " " + data.access_token + ";expires=" + new Date(exp).toGMTString() + ";domain=" + domainName + "";
      }else{
      document.cookie =
        "token=" + data.token_type + " " + data.access_token + "; domain=" + domainName + "";
      }
    },
    forgotPassword: function() {
      this.$root.forgoPasswordDialog();
    },
    signupDialog: function(url) {
      this.$root.signupDialog();
    },
    submit: function() {
      
      this.errors = [];
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
          $('input[name="username"]').val($("#email").val());
          self.isLoading = true;
          $.ajax({
            url: "/api/v1/users/login",
            type: "post",
            data: form.serialize(),
            dataType: "json",
            success: function(_response) {
              // self.saveSession(_response)

              $.ajax({
                url: "/oauth/token ",
                type: "post",
                data: form.serialize(),
                dataType: "json",
                success: function(_response) {
                  self.saveSession(_response)
                  if (self.$parent.url.length) {
                    if(self.$parent.url.includes("http"))
                     location = self.$parent.url;
                    else
                location.pathname = self.$parent.url;
              } else {
            
                location.reload();
                  //self.isLoading = false;
              }
                },
                complete: function(_response) {
                   
                },
                error: function(_response) {
                  //this.errors = JSON.parse(_response.responseText).errors
                  self.errors = {
                    email: ["بيانات غير صحيحة"]
                  };
                  self.isLoading = false;
                  // Handle error
                }
              });
            },
            complete: function(_response) {
             
            },
            error: function(_response) {
                self.isLoading = false;
              //this.errors = JSON.parse(_response.responseText).errors
              self.errors = {
                email:  ["بيانات غير صحيحة"]
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