/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');
window.$ = window.jQuery = require('jquery');
// window.moment = require('moment')
window.Vue = require('vue');
require('jquery-validation');
require('./../../../node_modules/jquery-validation/dist/localization/messages_ar')
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('login-component', require('./components/loginComponent.vue'));
Vue.component('signup-component', require('./components/signupComponent.vue'));
Vue.component('properties-component', require('./components/propertiesComponent.vue'));
Vue.component('filters-component', require('./components/filtersComponent.vue'));
Vue.component('map-component', require('./components/mapComponent.vue'));
Vue.component('addoffer-component', require('./components/addofferComponent.vue'));
Vue.component('offers-component', require('./components/offersComponent.vue'));
const app = new Vue({
    el: '#app',
    data() {
        return {
          url: "",
          cities: [],

        };
      },
    methods:{
        priceChange: function(value){
           this.currenPrice = value.path["0"].value  + " " + "ريال";
        },
        lastUpdate: function (date) {
            return "أخر تحديث في "  + " " +  moment(date).lang("ar").format(' DD MMMM YYYY') ;
          },
        deleteImage:function(id){
            $.post('/images/'+id+'',function(data){

            });
        },
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
          },
    },

    mounted() {
        var self = this;
        setTimeout(() => { $(".city_id_js").change(function(){
         var value = $(this).parent().find(".hidden-input").val();
         $.ajax({
            url: '/api/v1/regions/'+value +'',
            type: "GET",
            success: function(_response) {
                self.cities = _response.data
                var districtContianer = $('#districtContianer')
                var currentRegion =  $('#currentRegion').val();
                if(districtContianer.length){
                    districtContianer.empty();
                    for (let i = 0; i < self.cities.length; i++) {
                        if(self.cities[i].id == currentRegion){
                        districtContianer.append( '<li class="mdl-menu__item" data-val='+self.cities[i].id +' data-selected="true">'+self.cities[i].title+'</li>' );
                        }else{
                            districtContianer.append( '<li class="mdl-menu__item" data-val='+self.cities[i].id +'>'+self.cities[i].title+'</li>' );
                        }
                    }
                }
                
            },
            complete: function(_response) {
                setTimeout(() => {
                    getmdlSelect.init('.getmdl-select__city');
                }, 0);
                
            },
        });
        });}, 0);
    }

});

require('./material.min')
require('./main')