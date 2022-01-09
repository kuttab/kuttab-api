<template>
    <router-view></router-view>
</template>

<style lang="scss">
@import "~bootstrap-vue/dist/bootstrap-vue.css";
@import "~perfect-scrollbar/css/perfect-scrollbar.css";
@import "~socicon/css/socicon.css";
@import "~animate.css";
@import "~@fortawesome/fontawesome-free/css/all.css";
@import "~line-awesome/dist/line-awesome/css/line-awesome.css";
@import "plugins/flaticon/flaticon.css";
@import "plugins/flaticon2/flaticon.css";
@import "plugins/keenthemes-icons/font/ki.css";
@import "../sass/style.vue";
//@import "../css/style.vue.rtl";
</style>


<script>
import { OVERRIDE_LAYOUT_CONFIG } from "./store/config.module";

export default {
    name: "App",
    mounted() {
        this.$store.dispatch(OVERRIDE_LAYOUT_CONFIG);
    }
}
</script>
