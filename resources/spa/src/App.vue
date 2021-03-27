<template>
  <div id="wrapper" class="vh-100">
    <SideBar />
    <!-- 主要內容 -->
    <div class="main vh-100 d-flex flex-column">
      <!-- 麵包屑-->
      <BreadCrumbs />
      <!-- 渲染畫面-->
      <div class="render">
        <router-view />
      </div>
    </div>
  </div>
</template>
<script>
import SideBar from "./components/SideBar";
import BreadCrumbs from "./components/BreadCrumbs";

export default {
  name: "app",
  components: {
    SideBar,
    BreadCrumbs,
  },
  mounted() {
    console.log("App is mounted...");
  },
  watch: {
    $route() {
      let { siteName = "" } = this.$baseSetting;
      let { title = "" } = this.$route.meta;
      document.title = `${siteName} ${title && " | " + title} `;
    },
  },
};
</script>

