import Vue from 'vue'
import App from './App.vue'
import common from './common';
import router from './routers';

Vue.config.productionTip = false;

//基礎設定
Vue.prototype.$baseSetting = {
  siteName:'後臺' //網站名稱
};

let resource = [
  {
    source:'css',
    url:'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'
  }
];

common.loadResource(resource);

router.beforeEach((to, from, next) => {

  
  next();
});

new Vue({
  router,
  render: h => h(App),
}).$mount('#app');
