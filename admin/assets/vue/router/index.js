import Vue from "vue";
import Router from "vue-router";
import Home from "../pages/Home.vue";
import Videos from "../pages/Videos.vue";

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: "/",
      name: "Home",
      component: Home,
    },
    {
      path: "/videos",
      name: "Videos",
      component: Videos,
    },
  ],
});
