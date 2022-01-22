<template>
    <router-view class="h-100" style="font-family: DoridKufi-regular"></router-view>
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
</style>


<script>
import { OVERRIDE_LAYOUT_CONFIG } from "./store/config.module";
import i18nService from "./services/i18n.service";

export default {
    name: "App",
    mounted() {
        this.setLang()
        this.$store.dispatch(OVERRIDE_LAYOUT_CONFIG);
    },
    computed: {
        activeLanguage() {
            return i18nService.getActiveLanguage();
        }
    },
    methods:{
        setLang(){
            let lang = this.activeLanguage
            if (lang == 'ar'){
                require("../css/style.vue.rtl.css");
                document.body.setAttribute('direction','rtl')
                document.body.setAttribute('dir','rtl')
                document.body.style.direction = "rtl";
            }else {
                require("../sass/style.vue.scss");
            }
        }
    }
}
</script>
