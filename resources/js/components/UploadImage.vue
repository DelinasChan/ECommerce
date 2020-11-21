<template>
    <div 
        class="upload" :percent="percent"
        style="width:220px ; height:150;"
    >
        {{ percent }}%
    </div>
</template>

<script>

import axios from "axios" ;

export default {
    name: 'UploadImage',
    props: ['image'],
    mounted(){

        let form = new FormData();
        form.append( "image" , this.image ) ;

        axios({
            method: 'post', data: form ,
            url: 'http://localhost:8000/api/s3/upload',
            headers: {
                'accept': 'application/json',
                'Content-Type': `multipart/form-data; boundary=${form._boundary}`,
            }
        }).then(( response ) => { console.log( response ); });

    },
    data(){
        return {
            percent:0
        }
    },
    methods:{

    }
}
</script>