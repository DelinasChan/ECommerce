<template>
    <div class="list-container" > 
        <div class="orders">

            <div 
                v-for="order in data"  class="render-item"
                :key="order.id" @click="setItem( order )"
            >
                <div>
                    <a> {{ order.id }}</a>
                </div>
                <div>
                    <a> {{ order.payResult }}</a>
                </div>

                <div>
                    <a>{{ order.createdAt }}</a>
                </div>
            </div>
        </div>
        <div id="parginInfo">
            <a 
                v-for=" page in lastPage " :key="page"
                @click="changePage( page )" 
            >
                {{ page }}
            </a>
        </div>
        <div id="orderDialog" v-if="show" @click="close" >
            <div class="content">
                <div>{{ tradeNo || "交易未完成" }}</div>
                <div>
                    <div v-for="data in item " class="item" >
                        <p @click="openWindow(data.productId)" >
                            {{ data.productName }} {{ data.price }} X {{ data.quant }} 總共 {{ data.price * data.quant }} 
                        </p>
                    </div>
                </div>
                <div>
                    小計 {{ subTotal }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return { data:[] , page:1 , lastPage:0 , item:[] , show:false , tradeNo:"" , subTotal:0 }
    },
    created(){
        this.getData();
    },
    methods:{
        async getData(){
            let url = `/api/dashboard/orders?page=${ this.page }` ; 
            let { lastPage , data } = await ( await fetch( url ) ).json() ;
            this.lastPage = lastPage ;
            this.data = data ;
        },
        changePage( page ){
            this.page = page ;
            this.getData();
        },
        setItem( order ){

            let subTotal = 0 ;
            order.item.forEach(({ price , quant })=>{
                subTotal += price * quant ; 
            });
            this.item = order.item ;
            this.tradeNo = order.ecPay_tradeNo ;
            this.show = true ;
            this.subTotal = subTotal ;

        },
        close({ target }){
            if( $( target ).attr("id") == "orderDialog" ){
                this.show=false ;
                this.item = []  ;
            };
        },
        openWindow( productId ){
            window.open( `/product/${ productId }`,"blank");
        }
    }
}
</script>