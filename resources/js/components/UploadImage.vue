<template>
    <div 
        class="upload"
        style="border:1px solid black ;"
    >
        {{ percentCompleted }}%
    </div>
</template>

<script>

import axios from "axios" ;

export default {
    name: 'UploadImage' , props: [ 'image' , "index" ],
    mounted(){

        let form = new FormData();
        form.append( "image" , this.image ) ;

        axios({
            method: 'post', data: form ,
            url: '/api/s3/upload',
            headers: {
                'accept': 'application/json',
                'Content-Type': `multipart/form-data;`,
            },
            onUploadProgress:( progressEvent ) => {
                this.percentCompleted = Math.floor((progressEvent.loaded * 100) / progressEvent.total) ;
            }
        }).then(( response ) => { 
                let { result:image } = response.data ;
                if( image ){
                    let paramter = { index:this.index , image }
                    this.$emit( "changeCollection" , paramter );
                }
            });
    },
    data(){
        return {  percentCompleted:0 }
    }
}
</script>