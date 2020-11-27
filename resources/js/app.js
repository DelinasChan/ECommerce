require('./bootstrap');

window.Vue = require("vue");
import Vuex from 'vuex'
Vue.use( Vuex );

import MediaLibrary from "./components/Medialib" ;

new Vue({
    el:"#darkBox" ,
    components:{
        "media-library":MediaLibrary ,
    }
});

new Vue({
    el:"#product-list" ,
    components:{
        "media-library":MediaLibrary ,
    }
});
