import VueRouter from 'vue-router';
import Vue from 'vue';

import StoreRouter from './storeRouter';

Vue.use(VueRouter);

/**
 * RouterObject type definition
 * @typedef  {Object} RouterObject - 路由物件
 * @property {string} defaultPath - 預設路徑
 * @property {string} firstName   - 預設路徑名稱
 * @property {Array.<{path:string,name:string}>} routes
*/

/**
 * @description 路由展開設定前綴
 * 
 * @param {RouterObject} router - 路由
 * 
 * @returns {Array.<{path:string,name:string}>} 
*/
let routesSprea = ({ routes , defaultPath , firstName = '' }) => {
    let data = routes.map(({ path = '' , ...options })=>{
        const pathMap =['/dashboard',defaultPath];
        if(!options.data)options.data = {};
        if(path)pathMap.push(path);
        
        //設定麵包屑
        let { laterNames = [] } = options.props ; 
        options.data.breadcrumbs = [firstName,...laterNames].join('/');
        return  {
            path:pathMap.join('/'),
            ...options
        };
    });
    return data ;
};

export default new VueRouter({
    mode:'history',
    routes:[
        {
            path:'/dashboard',
            name:'dashboard',
            label:'首頁',
            icon:'icon i-dashboard',
            meta:[
                {
                    'name':'後臺首頁'
                }
            ],
            component:()=>  import(/* webpackChunkName: 'static/dashboard/chunk/dashboard' */ '@/views/dashboard')
        },
        ...routesSprea(StoreRouter),
    ]
})