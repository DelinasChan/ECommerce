<template>
  <div id="wrapper" class="vh-100">
    <SideBar />
    <!-- 主要內容 -->
    <div class="main vh-100">
      <BreadCrumbs />
      <router-view />
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
};
</script>

