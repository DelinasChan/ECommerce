require('./bootstrap');

window.Vue = require("vue");
import Vuex from 'vuex'
Vue.use( Vuex );

import MediaLibrary from "./components/Medialib" ;
import ProductList from "./components/ProductList" ;
import OrderList   from "./components/OrderList" ;

if( document.getElementById("darkBox") )
{
    new Vue({
        el:"#darkBox" ,
        components:{
            "media-library":MediaLibrary ,
        }
    });
};


if( document.getElementById("data-list") ){
    new Vue({
        el:"#data-list" ,
        components:{
            "product-data":ProductList ,
            "order-data": OrderList
        }
    });
};

