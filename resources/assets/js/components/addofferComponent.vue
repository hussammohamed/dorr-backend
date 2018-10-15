<template>
  <form action="#" id="addOfferForm">
                    <input v-model="propertyid" type="hidden" value="" name="property_id"/>
            
                    <div v-if="auth" class="overlay-offer">
                        <h5>
                            لايمكن إضافة عرض  سعر الا ان تكون مسجل
                        </h5>
                        <a @click="login" class="mdl-button  mdl-js-button mdl-js-ripple-effect  mdl-button--colored">
                            تسجيل دخول
    
                        </a>
                    </div>

                 
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" name="price" id="sample3">
                        <label class="mdl-textfield__label" for="sample3">السعر</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea required class="mdl-textfield__input" type="text" name="description" rows="3" id="sample5"></textarea>
                        <label class="mdl-textfield__label" for="sample5">أضف تعليق</label>
                    </div>
                    <button @click="addOffer" class="mdl-button  mdl-js-button mdl-js-ripple-effect  mdl-button--colored u-full-width">
                        أرسال

                    </button>
                    <span class="card-label top-label-right has-primary-base-bg">قدم عرض سعر</span>
                </form>
</template>

<script>
export default {
  props: ["auth", "propertyid", "uproperties"],
  methods: {
    login(){
      this.$root.loginDialog();
    },
    addOffer() {
         var self = this;
          $("#addOfferForm").validate({
               highlight: function (element) {
                $(element)
                    .closest(".mdl-textfield,.mdl-checkbox")
                    .addClass("is-invalid");
            },
            unhighlight: function (element) {
                $(element)
                    .closest(".mdl-textfield,.mdl-checkbox")
                    .removeClass("is-invalid");
            },
            errorElement: "span",
            errorClass: "mdl-textfield__error",
            errorPlacement: function (error, element) {
    
                error.insertAfter(element);
            }
           });
      $("#addOfferForm").submit(function(event) {
        event.preventDefault();
        $.ajax({
          url: "/api/v1/property/offers/1/store",
          type: "post",
          data: $("#addOfferForm").serialize(),
          dataType: "json",
          success: function(_response) {
            swal("تم أضافة عرض بنجاح", {
              button: "موافق",
              icon: "success",
            }).then( value =>{
              location.reload();
            })
           
          },
          complete: function(_response) {},
          error: function(_response) {}
        });
      });

    }
  }
}
</script>