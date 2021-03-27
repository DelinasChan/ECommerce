//商家相關路由
export default {
    defaultPath:"orders",
    firstName:"訂單列表",
    routes:[
        {
            path:'',
            name:'OrderList',
            icon:'icon i-checklist',
            label:'訂單列表',
            meta:{
                title:'訂單列表'
            },
            component:()=> import(/* webpackChunkName: "static/dashboard/chunk/OrderList" */ '@/views/order')     ,
            props:{
                laterNames:[]
            },
        }
    ]
}
