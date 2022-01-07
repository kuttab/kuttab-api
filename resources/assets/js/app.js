require('./bootstrap');

import Vue from 'vue'
import VueI18n from 'vue-i18n'
import Vuex from 'vuex'
import VueRouter from "vue-router";
import router from "./router";

import App from "./App.vue";
import guest from "./layouts/guest";

Vue.use(VueI18n)
Vue.use(Vuex)
Vue.use(VueRouter)

Vue.component('guest-layout', guest)

new Vue({
    router,
    render: h => h(App)
}).$mount("#app")
