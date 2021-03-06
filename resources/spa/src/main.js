import Vue from 'vue'
import App from './App.vue'
import common from './common';
import router from './routers';
import components from "./components";
import * as VeeValidate from 'vee-validate';
import { ValidationProvider, ValidationObserver , extend } from 'vee-validate';
import * as rules from 'vee-validate/dist/rules';
import zh_TW from 'vee-validate/dist/locale/zh_TW'
import route from 'ziggy-js';
import { Ziggy } from './ziggy';
import axios from 'axios';
import ImageItem from "./components/ImageItem";
import { isArray } from 'lodash';

//設定規則語系
VeeValidate.localize({zh_TW});
VeeValidate.localize('zh_TW');

Vue.use(VeeValidate,{
  aria: true,
  classNames: {
    valid: 'is-valid',
    invalid: 'is-invalid'
  }
});

Vue.mixin({
  methods:{
    route:(name, params, absolute) => route(name, params, absolute, Ziggy),
    /**  
     * @param { string } type REST|FORM
    */
    fetch:(url,options = {}, useForm = false) => {

      if(!options.method)
      {
        options.method = 'get';
      }

      if(!options.headers)
      {
        options.headers = {};
      }
      
      //處理表單資料
      if(useForm)
      {
        let form = new FormData();
        let { data } = options ;
        options.headers['Content-Type'] = "multipart/form-data" ;
        form.append('method',options.method) ;

        if( !(data instanceof Object) || Array.isArray(data))
        {
          throw new Error('options.data with Form muse be Object');
        }

        for(let [key , value] of Object.entries(options.data))
        {
          if(isArray(value))
          {
            value.forEach((itemVal,index)=>{
              form.append(`${key}[${index}]`,itemVal);
            });
          }else{
            if(value instanceof File || typeof value !== 'object'){
              form.append(`${key}`,value);
            }else{
              for(let [subKey,value] in Object.entries(options.data))
              {
                form.append(`${key}[${subKey}]`,value);
              };
            }
          }
        }

        options.data = form ;
      }
      
      return axios({
        url,
        ...options
      });
      
    }
  }
})
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
Vue.component('ImageItem',ImageItem);

let resource = [
  {
    source:'css',
    url:'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'
  }
];

common.loadResource(resource);
console.log(Ziggy.routes)
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
