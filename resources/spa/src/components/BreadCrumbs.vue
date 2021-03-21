<template>
  <div class="breadcrumbs">&nbsp;</div>
</template>
<script>
export default {
  name: "Breadcrumbs",
  data() {
    return {
      breadcrumbs: [],
    };
  },
  watch: {
    $route() {
      console.log("Crumbs", this.$route);
    },
  },
};
</script>