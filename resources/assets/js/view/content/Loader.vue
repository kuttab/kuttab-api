<template>
  <!-- begin::Page loader -->
  <div class="page-loader page-loader-logo">
    <img alt="Logo" :src="'./media/logos/logo-letter-1.png'" width="100" />
    <div class="spinner" v-bind:class="spinnerClass || 'spinner-primary'"></div>
  </div>
  <!-- end::Page Loader -->
</template>

<script>
export default {
  name: "Loader",
  props: {
    logo: String,
    spinnerClass: String
  }
};
</script>
