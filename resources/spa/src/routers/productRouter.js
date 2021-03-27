export default {
    defaultPath:"products",
    firstName:"商品列表",
    routes:[
        {
            path:'',
            name:'ProductList',
            icon:'icon i-goods',
            label:'商品列表',
            component:()=>import(/* webpackChunkName: "static/dashboard/chunk/product" */ '@/views/Product')  ,   
            meta:{
                title:'商品列表'
            },
            props:{
                laterNames:[]
            },
        },
        {
            path:'edit/:id',
            name:'EditProduct',
            label:'商品設定',
            meta:{
                title:'商品設定'
            },
            component:()=> import(/* webpackChunkName: "static/dashboard/chunk/EditProductForm" */ '@/views/product/EditProductForm')     ,
            props:{
                laterNames:['商品設定']
            },
        }
    ]

}