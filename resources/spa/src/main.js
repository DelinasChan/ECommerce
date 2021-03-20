import Vue from 'vue'
import App from './App.vue'
import common from './common';
import router from './routers';

Vue.config.productionTip = false;

let resource = [
  {
    source:'css',
    url:'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css'
  }
];

common.loadResource(resource);

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
