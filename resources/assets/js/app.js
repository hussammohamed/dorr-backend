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
require('../js/carousel.js')
window.autosize = require('../js/autosize.min.js')
import myUpload from 'vue-image-crop-upload';
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
Vue.component('report-component', require('./components/reportComponent.vue'));
Vue.component('success-component', require('./components/successComponent.vue'));
Vue.component('mapview-component', require('./components/mapViewComponent.vue'));
Vue.component('forgot-password-component', require('./components/forgotPasswordComponent.vue'));
Vue.component('add-comment-component', require('./components/addCommentComponent'));
const app = new Vue({
    el: '#app',
    data() {
        return {
            url: "",
            cities: [],
            show: true,
            params: {
                name: 'avatar'
            },
            headers: {
            },
            imgDataUrl: ""

        };
    },
    components: {
        'my-upload': myUpload
    },
    methods: {
        toggleShow() {
            this.show = !this.show;
        },
        /**
         * crop success
         *
         * [param] imgDataUrl
         * [param] field
         */
        cropSuccess(imgDataUrl, field) {

            // this.imgDataUrl = imgDataUrl;
        },
        /**
         * upload success
         *
         * [param] jsonData  server api return data, already json encode
         * [param] field
         */
        cropUploadSuccess(jsonData, field) {
           
            this.imgDataUrl = jsonData.avatar;
        },
        /**
         * upload fail
         *
         * [param] status    server api return error status, like 500
         * [param] field
         */
        cropUploadFail(status, field) {

        },
        priceChange: function (value) {
            this.currenPrice = value.path["0"].value + " " + "ريال";
        },
        lastUpdate: function (date) {
            return "أخر تحديث في " + " " + moment(date).lang("ar").format(' DD MMMM YYYY');
        },
        date: function (date){
            return  moment(date).lang("ar").format(' DD MMMM YYYY');
        },
        getCookie(name) {
            var value = "; " + document.cookie;
            var parts = value.split("; " + name + "=");
            if (parts.length == 2) return parts.pop().split(";").shift();
          },
        getYoutube: function (url) {
            // var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            // var match = url.match(regExp);

            // if (match && match[2].length == 11) {
            //     var videoId = match[2];
            //     var iframeMarkup = '//www.youtube.com/embed/' + videoId;
            //     return iframeMarkup;
            // } else {
            //     return 'error';
            // }
            var iframeMarkup = '//www.youtube.com/embed/' + url + '?enablejsapi=1';
            
             return iframeMarkup;

        },
        imgYoutube: function (url) {
            // var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            // var match = url.match(regExp);

            // if (match && match[2].length == 11) {
            //     var videoId = match[2];
            //     var iframeMarkup = 'http://img.youtube.com/vi/' + videoId + '/0.jpg';
            //     return iframeMarkup;
            // } else {
            //     return 'error';
            // }
            var iframeMarkup = 'http://img.youtube.com/vi/' + url + '/0.jpg';
             return iframeMarkup;
        },
        addCommas(num, begText, endText) {
            num += '';
            var x = num.split('.');
            var x1 = x[0];
            var x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            if (begText && endText) {
                return begText + x1 + x2 + endText;
            }
            else if (begText) {
                return x1 + x2 + begText;
            } else {
                return x1 + x2;
            }

        },
        deleteImage: function (id) {
            swal({
                title: "هل أنت متأكد ؟",
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ["ألغاء", "موافق"],
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '/api/v1/property/images/' + id + '/delete',
                            type: 'PUT',
                            success: function (result) {
                                swal("تم مسح الصورة بنجاح", {
                                    button: "موافق",
                                    icon: "success",
                                });
                                $('#image' + id).remove();
                            }
                        });
                    } else {

                    }
                });
        },
        propertyfeatured: function(id, text){
            $.ajax({
                url: '/api/v1/properties/' + id + '/featured',
                type: 'POST',
                success: function (result) {
                    swal(text, {
                        button: "موافق",
                        icon: "success",
                    }).then(value =>{
                        location.reload();
                    })
                }
            });
        },
        reportDialog: function () {
            reportDialog.showModal();
        },
        sucssesDialog: function () {
            successDialog.showModal();
        },
        loginDialog: function (url) {
            if (url) {
                this.url = url;
            }
            if (! signupDialog.showModal) {
                dialogPolyfill.registerDialog(signupDialog);
                dialogPolyfill.registerDialog(loginDialog);
                dialogPolyfill.registerDialog(forgotPasswordDialog);
               

              }
            //signupDialog.close();
            loginDialog.showModal();

        },
        signupDialog: function (url) {
            loginDialog.close();
            signupDialog.showModal();

        },
        forgoPasswordDialog: function () {
            loginDialog.close();
            forgotPasswordDialog.showModal();
        },
        mapDialog: function () {
            var self = this;
            if (! mapDialog.showModal) {
                dialogPolyfill.registerDialog(forgotPasswordDialog);
            }
            var dialogPromise = new Promise(function(resolve, reject){
                var mapRender =  mapDialog.showModal();
                resolve(mapRender);
            });
            dialogPromise.then(function(){
                var lat = parseFloat($("#map").attr('data-lat'));
                var long = parseFloat($("#map").attr('data-long'));
                var mapView = $("#map").attr('data-view');
                var uluru = new google.maps.LatLng(lat, long);
                var map = new google.maps.Map(document.getElementById('mapView'), {
                    zoom: 13,
                    center: uluru,
                });
                if (mapView == 1) {
                    var marker = new google.maps.Marker({
                        position: uluru,
                        color: '#4ba6a2',
                    });
                    marker.setMap(map);
                } else if (mapView == 2) {
                    var cityCircle = new google.maps.Circle({
                        strokeColor: '#4ba6a2',
                        fillColor: '#4ba6a2',
                        strokeWeight: 0,
                        fillOpacity: 0.45,
                        strokeOpacity: 0.35,
                        map: map,
                        center: uluru,
                        radius: 500
                    });
                } else if (mapView == 3) {
                    map.setZoom(10);
                }
            })
                
              
        },
        deleteOffer: function (offerId) {
            swal({
                title: "هل أنت متأكد ؟",
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ["ألغاء", "موافق"],
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '/api/v1/property/offers/' + offerId + '/destroy',
                            type: "Delete",
                            success: function (_response) {
                                swal("تم مسح العرض بنجاح", {
                                    button: "موافق",
                                    icon: "success",
                                });
                                $('#offer' + offerId).remove();
                            },
                            complete: function (_response) { },
                            error: function (_response) {
                                //this.errors = JSON.parse(_response.responseText).errors
                                // Handle error
                            }
                        });
                    } else {

                    }
                });

        },
        closeDialog: function (el) {
            let rect = el.getBoundingClientRect();
            var e=window.event || event;
            let isInDialog;
                isInDialog = (rect.top <= e.clientY && e.clientY <= rect.top + rect.height && rect.left <= e.clientX && e.clientX <= rect.left + rect.width);
      

            if (!isInDialog) {
                el.close();
            }
        },
    },
    created() {
        var self = this;
        // $.get('/api/v1/user/avatar', function (data) {
        //     self.imgDataUrl = data.avatar;
        // }).fail(function () {
        //     self.imgDataUrl = "/images/face.png";
        // })
        var token = this.getCookie('token');
        this.headers = {"Authorization": token};
        $.ajax({
            url: "/api/v1/user/avatar",
            type: "get",
            beforeSend: function(xhr){xhr.setRequestHeader('Authorization', token);},
            success: function(data) {
                self.imgDataUrl = data.avatar;
            }

            });
    },
    mounted() {

        this.show = !this.show;
        
    }

});

require('./material.min')
require('./main')