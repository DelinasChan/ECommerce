<template>
  <div>
    <h2>編輯商品表單</h2>
  </div>
</template>
<script>
export default {
  name: "EditProductForm",
  props: ["id"],
  data() {
    return {};
  },
  mounted() {
    console.log(this.id);
  },
};
</script>