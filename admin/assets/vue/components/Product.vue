<template>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Product select</label>
    <select class="form-control product-select" v-model="selected">
      <option value="">Select a product</option>
      <option v-for="(option, i) in options" v-bind:value="option.id" v-bind:key="`${i}`">
        {{ '#' + option.id + ' ' + option.name }}
      </option>
    </select>
  </div>
</template>


<script>

import WooCommerceRestApi from "@woocommerce/woocommerce-rest-api";
const WooCommerce = new WooCommerceRestApi({
  url: 'http://localhost/itbz', // Your store URL
  consumerKey: 'ck_21784c84d2111e00ce0575880c302b8c57f302bf', // Your consumer key
  consumerSecret: 'cs_9fcd70811921b259da213a7ebe972de708ae8e35', // Your consumer secret
  version: 'wc/v3' // WooCommerce WP REST API version
});

export default {
  name: "Product",
  data() {
    return {
      msg: "I am card component",
      options: [],
      selected: ''
    };
  },
  mounted: function() {
    WooCommerce.get("products?per_page=100")
  .then((response) => {
    this.options = response.data
  })
  .catch((error) => {
    console.log(error);
  });
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
