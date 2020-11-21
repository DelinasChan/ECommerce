<template>
    <div 
        class="render"
        @drop="onDrop" @dragenter="onDrag" @dragover="onDrag"
    >
        <div class="title">
            <a>媒體庫</a>
        </div>
        <div class="content" >
            <!-- 圖片列表 -->
            <div class="left images">
                <div 
                    v-for="( image , index ) in images" 
                    class="picture" :key="index" 
                > 
                    <UploadImage v-if="!image.id" :image='image' />
                    <img 
                        :src="image.src" :img="image.id"
                        width="220" height="150"
                    />
                </div>
            </div>
            <!--圖片編輯區塊-->
            <div class="right">
                <div v-if=" image.id " class="edit-context">
                    <!--- img.alt -->
                    <div class="edit-block">
                        <a>替代文字: </a>
                        <input type="text" v-model="image.alt">
                    </div>
                    <!--- img.name -->
                    <div>
                        <a>圖片名稱:</a>
                        <input type="text" v-model="image.name" readonly >
                    </div>
                    <!--- img.src -->
                    <div>
                        <a>圖片網址:</a>
                        <input 
                            type="text" v-model="image.src" readonly 
                            @click="copyText"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import UploadImage from "./UploadImage" ;


export default {
  mounted(){

    //   let array = [] ;
    //   for( let id = 0 ; id < 40 ; id++ )
    //   { 
    //       let src ="https://images.pexels.com/photos/1108099/pexels-photo-1108099.jpeg" ;
    //       let copyPropType = { id , name:`圖片名稱_${ id }` , "alt":"替代文字" , src } ;
    //       array.push( copyPropType );
    //   };
    //   this.images = array ;

  },
  data() {
      return {
        images:[] , image:{}
      }
  },
  components:{    
    UploadImage
  },
  methods:{
    copyText:function({ target:node }){
        let range = document.createRange();
        range.selectNode( node );
        let selection = window.getSelection();
        if(selection.rangeCount > 0) selection.removeAllRanges();
        selection.addRange(range);
        document.execCommand('copy');
    },
    onDrag: function( e ) {
        e.stopPropagation();
        e.preventDefault();
    },
    onDrop:function( e ){
        e.stopPropagation() ;
        e.preventDefault()  ;
        let dt = e.dataTransfer ;
        // console.log( dt.files )
        /** 過濾 JPEG JPG 資料 */
        let filter = new Array( ...dt.files ).filter(( image ) => { 
            return ["image/jpeg","image/jpg"].indexOf( image.type  ) == -1 
        }) ;

        if( filter.length >0 ){
            alert("圖片只能上傳 JPEG,JPG");
            return false ;
        };
        
        this.images.unshift( ...dt.files );
    
    }
  }
}
</script>
