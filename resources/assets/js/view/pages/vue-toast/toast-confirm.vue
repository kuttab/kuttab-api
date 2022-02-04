<template>
    <div>
        <span>{{ message }}</span>
        <button class="btn btn-sm btn-light-danger mr-3" @click.stop="clicked">نعم</button>
    </div>
</template>
<script>
export default {
    props: ["message"],
    methods: {
        clicked() {
            // Emit a "click" event when clicked.
            // Can be any event though and even pass parameters back
            this.$emit("click");
        }
    }
};
</script>
<style>
</style>
