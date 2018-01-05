
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');
window.$ = window.jQuery = require('jquery');
window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('login-component', require('./components/loginComponent.vue'));
Vue.component('signup-component', require('./components/signupComponent.vue'));
const app = new Vue({
    el: '#app',
    data() {
        return {
          url: ""
        };
      },
    methods:{
        loginDialog: function(url){
            if (url){
                this.url = url;
            }
            signupDialog.close();
            loginDialog.showModal();

        },
        signupDialog: function(url){
            loginDialog.close();
            signupDialog.showModal();

        },
        closeDialog: function(el){
            let rect = el.getBoundingClientRect();
            let isInDialog = (rect.top <= event.clientY && event.clientY <= rect.top + rect.height && rect.left <= event.clientX && event.clientX <= rect.left + rect.width);
            if (!isInDialog) {
                el.close();
              }
          }
    },
    mounted() {}
});

require('./material.min')
require('./main')
require('./getmdl-select.min');