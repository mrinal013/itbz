<template>
  <div class="home">
      <div class="container">
      <h2>Special URL Setting</h2>
        <div class="row mt-5">
          <div class="col-sm-3">
            <label>Select products</label>
          </div>
          <div class="col-sm-9">
            <multiselect v-model="value" :options="options" :multiple="true"></multiselect>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-sm-3">
            <label for="slug">Special page slug</label>
          </div>
          <div class="col-sm-9">
            <input type="text" v-model="slug" class="form-control" id="slug"/>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-sm-3">
            <label for="wckey">WooCommerce Consumer key</label>
          </div>
          <div class="col-sm-9">
            <input type="text" v-model="wckey" class="form-control" id="wckey"/>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-sm-3">
            <label for="wcsecret">WooCommerce Consumer secret</label>
          </div>
          <div class="col-sm-9">
            <input type="text" v-model="wcsecret" class="form-control" id="wcsecret"/>
          </div>
        </div>
        <div class="clearfix"></div>
        <button class="btn btn-primary mt-5" id="special-page-save" @click="specialPageSave">Save</button>   
      </div>
  </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
import axios from "axios";
import WooCommerceRestApi from "@woocommerce/woocommerce-rest-api";

const WooCommerce = new WooCommerceRestApi({
  url: object.siteurl, // Your store URL
  consumerKey: object.wckey, // Your consumer key
  consumerSecret: object.wcsecret, // Your consumer secret
  version: 'wc/v3' // WooCommerce WP REST API version
});

export default {
  name: "Home",
  components: {
    Multiselect
  },
  data() {
    return {
      value: null,
      slug: 'video-forum',
      wckey: object.wckey,
      wcsecret: object.wcsecret,
      options: [],
      rows: [{id:0}],
    };
  },
  methods: {
    addPage: function() {
      let rowLength = this.rows.length;
      this.rows.push({
        id: rowLength
      })
    },
    removePage: function(index) {
      this.$delete(this.rows, index)
    },
    specialPageSave: function() {
      let formData = new FormData;
      formData.append('action', 'itbz_callback');
      formData.append('products', this.value);
      formData.append('slug', this.slug);
      formData.append('wckey', this.wckey);
      formData.append('wcsecret', this.wcsecret);

      axios
      .post(object.ajaxurl, formData)
      .then(function(response) {
        console.log(response.data)
      })
      .catch(function (error) {
        console.log(error);
      });
    }
  },
  mounted: function() {
    WooCommerce.get("products?per_page=100")
    .then((response) => {
      for(let i = 0; i <= response.data.length; i++) {
        this.options.push(response.data[i].id)
      }
    })
    .catch((error) => {
      console.log(error);
    });
  },
};
</script>