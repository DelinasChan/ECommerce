//商家相關路由
export default {
    defaultPath:"editStore",
    firstName:"店家管理",
    routes:[
        {
            path:'',
            name:'EditStore',
            icon:'icon i-setting',
            label:'店家基礎設定',
            meta:{
                title:'店家基礎設定'
            },
            component:()=> import(/* webpackChunkName: "static/dashboard/chunk/store" */ '@/views/store')     ,
            props:{
                laterNames:['店家設定','XX的店家列表']
            },
        }
    ]
}
