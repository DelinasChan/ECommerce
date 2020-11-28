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
                    <UploadImage 
                        v-if="!image.id" :image='image' :index='index'
                        @changeCollection="changeCollection"

                    />
                    <img v-else  
                        :src="image.src" :img="image.id" 
                        @click="selectImg = JSON.parse( JSON.stringify( image ) ) "
                    />
                </div>
            </div>
            <!--圖片編輯區塊-->
            <div class="right">
                <div v-if=" selectImg.id " class="edit-context">
                    <!--- img.alt -->
                    <div >
                        <a>替代文字</a>
                        <input 
                            class="edit-block" type="text" v-model="selectImg.alt"
                            @keypress="changeImage"
                            style="border-bottom:1px solid black ;"
                        >
                    </div>
                    <!--- img.name -->
                    <div>
                        <a>圖片名稱</a>
                        <input type="text" v-model="selectImg.name" readonly >
                    </div>
                    <!--- img.src -->
                    <div >
                        <a>圖片網址</a>
                        <input 
                            type="text" v-model="selectImg.src" readonly="true"
                            @click="copyText"  style="cursor:pointer;"
                        >
                    </div>

                    <div class="selectBtn" >
                        <a @click="selectImage" > 
                            插入圖片
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

import UploadImage from "./UploadImage" ;


export default {
  data() { return { images:[] , selectImg:{} } },
  components:{ UploadImage },
  mounted(){
    /** 組件初始化 跟 伺服器請求該用戶圖片 */
    axios.get("/api/media")
        .then(( response ) => { this.images = response.data ; });
  },
  methods:{
    changeImage:async function({keyCode }){
        /** 輸入 enter 變更 替代文字 */
        if( keyCode == 13 ){
            let { id , alt } = this.selectImg ;
            await axios.post("/api/media/update",  { id , alt });
            this.images.forEach((image )=>{
                if( image.id == id ){
                    image.alt = alt ; 
                }
            })
        };
    },
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
        /** 過濾 JPEG JPG 資料 */
        let filter = new Array( ...dt.files ).filter(( image ) => { 
            return ["image/jpeg","image/jpg"].indexOf( image.type  ) == -1 
        }) ;

        if( filter.length >0 ){
            alert("圖片只能上傳 JPEG,JPG");
            return false ;
        };
        
        this.images.unshift( ...dt.files );
    
    },
    changeCollection:function( changeData ){
        let { index , image } = changeData ;
        let changeArr = JSON.parse( JSON.stringify( this.images ) );
        changeArr[ index ] = image ;
        this.images = changeArr ;
    },
    selectImage:function(){
        window.MediaLibrary.insertImage( this.selectImg );
    }

  }
}
</script>
