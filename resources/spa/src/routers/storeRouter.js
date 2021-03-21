//商家相關路由
export default {
    defaultPath:"store",
    firstName:"商家管理",
    routes:[
        {
            path:'editStore',
            name:'storeList',
            icon:'icon i-setting',
            label:'店家管理',
            component:()=> import(/* webpackChunkName: "static/dashboard/chunk/store" */ '@/views/store')     ,
            props:{
                laterNames:['店家設定','XX的店家列表']
            },
        }
    ]
}
