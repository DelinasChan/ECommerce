<template>
  <div id="app" class="spa container">
    <SideBar />
    <!-- 第一層 -->
    <router-view />
  </div>
</template>
<script>
import SideBar from './components/SideBar';

export default {
  name:"app",
  components:{
    SideBar
  },
  mounted(){
    console.log('App is mounted...')
  }
}
</script>

