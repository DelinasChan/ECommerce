import Vue from 'vue'
import App from './App.vue'
import common from './common';
Vue.config.productionTip = false

let sourceData = [
  {
    source:'css',
    url:'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css'
  }
];

common.loadResource(sourceData);

new Vue({
  render: h => h(App),
}).$mount('#app')
