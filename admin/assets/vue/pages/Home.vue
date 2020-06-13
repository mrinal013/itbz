<template>
  <div class="home">
      <h2>Special URL Setting</h2>
      <div class="container">
        <ul>
          <li v-for="(row, i) in rows" :key="row.id">
            <div class="row border d-flex align-items-center pt-3">
              <div class="col-5">
                <div class="form-group">
                  <select class="form-control" v-model="specialProductUrl.product[i]">
                    <option value="choice">Select a product</option>
                    <option v-for="(option, index) in options" :value="option.id" :key="index">
                      {{ '#' + option.id + ' ' + option.name }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Enter url" v-model="specialProductUrl.url[i]">
                </div>
              </div>
              <div class="col-1 alert">
                <button type="button" class="close text-danger" aria-label="Close" @click="removePage(i)">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </li>
        </ul>
        <button class="btn btn-primary float-right mt-3" @click="addPage">Add</button>
      </div>
      <div class="clearfix"></div>
    <button class="btn btn-primary mt-3" id="special-page-save" @click="specialPageSave">Save</button>   
  </div>
</template>

<script>
import WooCommerceRestApi from "@woocommerce/woocommerce-rest-api";
import Link from "../components/Link.vue";

const WooCommerce = new WooCommerceRestApi({
  url: 'http://localhost/itbz', // Your store URL
  consumerKey: 'ck_21784c84d2111e00ce0575880c302b8c57f302bf', // Your consumer key
  consumerSecret: 'cs_9fcd70811921b259da213a7ebe972de708ae8e35', // Your consumer secret
  version: 'wc/v3' // WooCommerce WP REST API version
});

export default {
  name: "Home",
  components: {
    Link
  },
  data() {
    return {
      rows: [{id:0}],
      options: [],
      specialProductUrl: {
        product: ['choice'],
        url: []
      },
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
    matchProductAndUrl: function(array) {
      let finalProductAndUrl = [],
      totalProduct = array.product.length,
      totalUrl = array.url.length,
      maxArray = Math.max(totalProduct, totalUrl),
      minArray = Math.max(totalProduct, totalUrl);

      for( let i = 0; i < maxArray; i++ ) {
        for( let j = 0; j < minArray; j++ ) {
          if( i === j ) {
            finalProductAndUrl[array.product[i]] = array.url[j];
          }
        }
      }

      return finalProductAndUrl;
    },
    specialPageSave: function() {
      let finalProductAndUrlArray = this.matchProductAndUrl(this.specialProductUrl);
      console.log(finalProductAndUrlArray)
    }
  },
  mounted: function() {
    WooCommerce.get("products?per_page=100")
    .then((response) => {
      this.options = response.data
    })
    .catch((error) => {
      console.log(error);
    });
  },
};
</script>