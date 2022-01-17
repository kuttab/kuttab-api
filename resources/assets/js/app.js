require('./bootstrap')

import Vue from "vue"
import Vuex from "vuex"
import VueRouter from "vue-router";
import router from "./router";
import store from "./store"
import ApiService from "./services/api.service";
import Toast from "vue-toastification";
import { VERIFY_AUTH } from "./store/auth.module";
import { RESET_LAYOUT_CONFIG } from "./store/config.module";
import App from "./App.vue";
import "bootstrap-vue"

// Global 3rd party plugins
import "popper.js";
import "tooltip.js";
import PerfectScrollbar from "perfect-scrollbar";
window.PerfectScrollbar = PerfectScrollbar;
import ClipboardJS from "clipboard";
window.ClipboardJS = ClipboardJS;

// Vue 3rd party plugins
import i18n from "./plugins/vue-i18n";
import vuetify from "./plugins/vuetify";
import "./plugins/portal-vue";
import "./plugins/bootstrap-vue";
import "./plugins/perfect-scrollbar";
import "./plugins/highlight-js";
import "./plugins/inline-svg";
import "./plugins/apexcharts";
import "./plugins/treeselect";
import "./plugins/metronic";
import "@mdi/font/css/materialdesignicons.css";
import "vue-toastification/dist/index.css";
import "./plugins/formvalidation";

const options = {
    rtl: true,
    position: 'top-center'
};

Vue.use(i18n)
Vue.use(Vuex)
Vue.use(VueRouter)
Vue.use(Toast, options);

// Scroll page to top on every route change
router.beforeEach((to, from, next) => {
    // Ensure we checked auth before each page load.
    Promise.all([store.dispatch(VERIFY_AUTH)]).then(next);

    // reset config to initial state
    store.dispatch(RESET_LAYOUT_CONFIG);

    // Scroll page to top on every route change
    setTimeout(() => {
        window.scrollTo(0, 0);
    }, 100);
});

// API service init
ApiService.init();

new Vue({
    router,
    i18n,
    store,
    vuetify,
    render: h => h(App)
}).$mount("#app")
