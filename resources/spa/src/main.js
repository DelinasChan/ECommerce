import Vue from 'vue'
import App from './App.vue'
import common from './common';
import router from './routers';
import components from "./components";
import * as VeeValidate from 'vee-validate';
import { ValidationProvider, ValidationObserver , extend } from 'vee-validate';
import * as rules from 'vee-validate/dist/rules';


Vue.use(VeeValidate);

//引用驗證規則
Object.keys(rules).forEach((rule) => {
  extend(rule, rules[rule]);
});


Vue.config.productionTip = false;

//基礎設定
Vue.prototype.$baseSetting = {
  siteName:'後臺' //網站名稱
};

Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver',ValidationObserver);

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

Object.entries(components).forEach(([name,comopnent])=>{
  Vue.component(name,comopnent);
});

new Vue({
  router,
  render: h => h(App),
}).$mount('#app');
