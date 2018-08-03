<template>
  <div class="text-area" >
                <textarea v-model="comment" class="comment-textbox mdl-textfield__input" rows="1"></textarea> 
                
                <button @click="addOffer" class="mdl-button  mdl-js-button mdl-js-ripple-effect  mdl-button--colored">
                        ارسال تعليق

                    </button>
                </div>
</template>

<script>
export default {
     props: ["propertyid", "offerid"],
    data() {
    return {
        comment: ""
    };
  },
  methods: {
    login() {
      this.$root.loginDialog();
    },
    addOffer() {
      console.log(this)
        var data = {
            "property_id": this.propertyid,
            "description": this.comment,
            "reply_on": this.offerid,

        }
      var self = this;
        $.ajax({
          url: "/api/v1/property/offers/1/store",
          type: "post",
          data: data,
          dataType: "json",
          success: function(_response) {
            swal("تم أضافة تعليق بنجاح", {
              button: "موافق",
              icon: "success"
            }).then(value => {
                //  location.reload();
            });
          },
          complete: function(_response) {},
          error: function(_response) {}
        });
     }
  },

  mounted() {
    autosize($(".comment-textbox"));
  }
};
</script>