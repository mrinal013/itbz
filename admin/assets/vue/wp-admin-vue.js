import Vue from "vue";
import App from "./App.vue";
import router from "./router";
// import axios from "axios";

import menuFix from "./utils/admin-menu-fix";

// Vue.use(axios);

Vue.config.productionTip = false;
/* eslint-disable no-new */
window.addEventListener("load", function() {
  new Vue({
    el: "#app",
    router,
    // axios,
    render: (h) => h(App),
  });
  menuFix("wp-admin-vue");
});
