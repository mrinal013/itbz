<template>
  <div class="home">
      <div class="container">
      <h2>Special URL Setting</h2>
        <div class="row mt-5">
          <div class="col-sm-3">
            <label>Select special product</label>
          </div>
          <div class="col-sm-9">
            <multiselect v-model="value" :options="options" :multiple="false"></multiselect>
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
        <h2 class="mt-5">WooCoommerce REST API setup</h2>
        <a href="https://woocommerce.github.io/woocommerce-rest-api-docs/#rest-api-keys">Please follow this</a>
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
        <h2 class="mt-5">Firebase config</h2>
        <a href="https://firebase.google.com/docs/storage/web/start">Please follow this </a>
        <div class="row mt-5">
          <div class="col-sm-3">
            <label for="apiKey">apiKey</label>
          </div>
          <div class="col-sm-9">
            <input type="text" v-model="apiKey" class="form-control" id="apiKey"/>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-sm-3">
            <label for="authDomain">authDomain</label>
          </div>
          <div class="col-sm-9">
            <input type="text" v-model="authDomain" class="form-control" id="authDomain"/>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-sm-3">
            <label for="databaseURL">databaseURL</label>
          </div>
          <div class="col-sm-9">
            <input type="text" v-model="databaseURL" class="form-control" id="databaseURL"/>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-sm-3">
            <label for="projectId">projectId</label>
          </div>
          <div class="col-sm-9">
            <input type="text" v-model="projectId" class="form-control" id="projectId"/>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-sm-3">
            <label for="storageBucket">storageBucket</label>
          </div>
          <div class="col-sm-9">
            <input type="text" v-model="storageBucket" class="form-control" id="storageBucket"/>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-sm-3">
            <label for="messagingSenderId">messagingSenderId</label>
          </div>
          <div class="col-sm-9">
            <input type="text" v-model="messagingSenderId" class="form-control" id="messagingSenderId"/>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-sm-3">
            <label for="appId">appId</label>
          </div>
          <div class="col-sm-9">
            <input type="text" v-model="appId" class="form-control" id="appId"/>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-sm-3">
            <label for="measurementId">measurementId</label>
          </div>
          <div class="col-sm-9">
            <input type="text" v-model="measurementId" class="form-control" id="measurementId"/>
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
      options: [],
      value: object.specialproduct ? object.specialproduct : null,
      slug: object.specialurl ? object.specialurl : null,
      wckey: object.wckey ? object.wckey : '',
      wcsecret: object.wcsecret ? object.wcsecret : '',
      apiKey: object.apiKey ? object.apiKey : '',
      authDomain: object.authDomain ? object.authDomain : '',
      databaseURL: object.databaseURL ? object.databaseURL : '',
      projectId: object.projectId ? object.projectId : null,
      storageBucket: object.storageBucket ? object.storageBucket : '',
      messagingSenderId: object.messagingSenderId ? object.messagingSenderId : '',
      appId: object.appId ? object.appId : '',
      measurementId: object.measurementId ? object.measurementId : '',
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
      console.log(object.nonce)
      let formData = new FormData;
      formData.append('action', 'itbz_callback');
      formData.append('nonce', object.nonce);
      formData.append('product', this.value);
      formData.append('slug', this.slug);
      formData.append('wckey', this.wckey);
      formData.append('wcsecret', this.wcsecret);
      formData.append('apiKey', this.apiKey);
      formData.append('authDomain', this.authDomain);
      formData.append('databaseURL', this.databaseURL);
      formData.append('projectId', this.projectId);
      formData.append('storageBucket', this.storageBucket);
      formData.append('messagingSenderId', this.messagingSenderId);
      formData.append('appId', this.appId);
      formData.append('measurementId', this.measurementId);

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
  mounted () {
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