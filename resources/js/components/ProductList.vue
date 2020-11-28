<template>
    <div class="list-container" > 
        <div class="products">
            
            <div 
                v-for="product in data"  class="render-item"
                :key="product.id"
            >
                <div>
                    <a> {{ product.name }}</a>
                </div>
                <div>
                    <a> 折價 {{ product.discountPrice }}</a>
                </div>
                <div>
                    <a> 售價 {{ product.discountPrice }}</a>
                </div>
                <div>
                    <a 
                        :href="'/dashboard/product/' + product.id" 
                        target="__blank"
                    >
                        編輯
                    </a>
                    <a @click="delProduct(product.id)" >
                        移除
                    </a>
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
    </div>
</template>

<script>
export default {
    data(){
        return { data:[] , page:1 , lastPage:0 }
    },
    created(){
        this.getData();
    },
    methods:{
        async getData(){
            let url = `/api/dashboard/products?page=${ this.page }` ; 
            let { lastPage , data } = await ( await fetch( url ) ).json() ;
            this.lastPage = lastPage ;
            this.data = data ;
        },
        delProduct( productId ){
            fetch(`/api/delete/product/${ productId }` , { method:"DELETE" })
                .then(( res ) => res.json() )
                .then( result => {
                    this.getData();
                });
        },
        changePage( page ){
            this.page = page ;
            this.getData();
        }
    }
}
</script>