<template>
    <div>
        {{this.$route.params.id}}
    </div>
</template>

<script>
import {SET_BREADCRUMB} from "../../../store/breadcrumbs.module";
import {SET_ACTION_BUTTON_CONFIG} from "../../../store/config.module";

export default {
    name: "Edit",
    mounted() {
        this.$store.dispatch(SET_BREADCRUMB, [
            { title: this.$t('USERS.TITLE'), route: "users" },
            { title: this.$t('USERS.EDIT.TITLE') }
        ]);
        this.$store.dispatch(SET_ACTION_BUTTON_CONFIG, { display: false,title:this.$t('MENU.NEW'),route:'/users/add' });
    }
}
</script>

<style scoped>

</style>
