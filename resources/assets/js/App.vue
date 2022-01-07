<template>
    <component lang="ar" :is="layout"/>
</template>

<script>
import guest from "./layouts/guest";

const defaultLayout = 'guest'

export default {
    name: "App",
    components: {
        guest
    },
    computed: {
        layout() {
            return this.$route.meta.layout || defaultLayout + '-layout'
        }
    }
}
</script>

<style scoped>

</style>
