import VueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(VueRouter);

export default new VueRouter({
    mode:'history',

    routes:[
        {
            name:'store',
            path:'store',
            component: ()=> import(/* webpackChunkName: "store" */ '../views/store/store.vue')
        }
    ]
})