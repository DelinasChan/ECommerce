export default {
    name:"product",
    path:"product",
    component:()=>import(/* webpackChunkName: "static/dashboard/chunk/product" */ '@/views/Product')     
}