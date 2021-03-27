import VueRouter from 'vue-router';
import Vue from 'vue';

import StoreRouter from './storeRouter';
import ProductRouter from './productRouter';
import OrderRouter from './orderRouter';

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

    //先找到最上層路由
    let firstRoute = routes.find(({ path }) => path === '');
    let data = routes.map(({ path = '' , ...options })=>{
        const pathMap =['/dashboard',defaultPath];
        if(!options.data) options.data = {};
        if(path.length > 0) pathMap.push(path) ;

        //設定麵包屑
        let { laterNames = [] } = options.props ; 
        options.meta.breadcrumbs = [firstName,...laterNames];
        let routeSetting = { path:pathMap.join('/'), ...options } ;
        if( path !== '' )
        {
            Object.assign(routeSetting,{ firstRoute })
        }
        
        return routeSetting ;
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
            meta:{
                title:'首頁'
            },
            props:{
                laterNames:[]
            },
            component:()=>  import(/* webpackChunkName: 'static/dashboard/chunk/dashboard' */ '@/views/dashboard')
        },
        ...routesSprea(StoreRouter),
        ...routesSprea(ProductRouter),
        ...routesSprea(OrderRouter),
    ]
})