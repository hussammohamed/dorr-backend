<template>
  <form action="#" id="addOfferForm">
                    <input v-model="propertyid" type="hidden" value="" name="property_id"/>
            
                    <div v-if="auth" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="name" type="text" id="sample25">
                        <label class="mdl-textfield__label" for="sample25">الأسم</label>
                    </div>
                   
                    <div v-if="auth" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" name="mobile"  id="sample26">
                        <label class="mdl-textfield__label" for="sample26">رقم الجوال</label>
                    </div>
                 
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" name="price" id="sample3">
                        <label class="mdl-textfield__label" for="sample3">السعر</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" type="text" name="description" rows="3" id="sample5"></textarea>
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
    addOffer() {
         var self = this;
      $("#addOfferForm").submit(function(event) {
        event.preventDefault();
        $.ajax({
          url: "/api/v1/property/offers/1/store",
          type: "post",
          data: $("#addOfferForm").serialize(),
          dataType: "json",
          success: function(_response) {
            // self.properties = _response.data;
            // self.bound = true;
            // if (self.kind != "properties") {
            //   self.kind = "properties";
            // } else {
            //   self.filterMap();
            // }
            location.reload();
          },
          complete: function(_response) {},
          error: function(_response) {}
        });
      });

    }
  }
}
</script>