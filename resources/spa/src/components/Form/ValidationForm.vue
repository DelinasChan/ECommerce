<template>
  <ValidationProvider ref="validation">
    <slot />
  </ValidationProvider>
</template>
<script>
export default {
  name: "EditForm",
  data() {
    return {
      schema: {},
    };
  },
  mounted() {
    console.log(this);
  },
};
</script>