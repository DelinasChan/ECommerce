<template>
  <div class="sideBar position-fixed vh-100 d-flex flex-column">
    <!-- 後臺標籤-->
    <div class="title">
      <router-link :to="{ name: 'dashboard' }"> 商家管理後台 </router-link>
    </div>
    <!-- 用戶資訊-->
    <div class="profile">
      <a class="user-name icon i-user">用戶姓名</a>
    </div>
    <!-- 連結列表-->
    <div class="link-list">
      <ul class="p-0">
        <li v-for="(route, index) in routes" :key="index">
          <router-link
            :to="{ name: route.name }"
            :class="{ active: route.name == $route.name, [route.icon]: true }"
          >
            {{ route.label || "分頁" }}
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  name: "SideBar",
  data: () => {
    return {
      routes: [],
    };
  },
  mounted() {
    this.routes = this.$router.options.routes;
    console.log(this.routes);
  },
};
</script>
