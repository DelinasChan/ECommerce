//商家相關路由
export default {
    defaultPath:"store",
    firstName:"商家管理",
    routes:[
        {
            name:'storeList',
            component:()=> import(/* webpackChunkName: "store" */ '@/views/store')     ,
            props:{
                laterNames:['店家設定','XX的店家列表']
            },
        },
        {
            path:'editStore',
            name:'editStore',
            component:{
                render:(h)=>(h)=h('div','<a>更新商家</a>')
            },
            props:{
                laterNames:['店家設定','XX的店']
            },
        }
    ]
}
