
//載入資源
let resource = [
    {
        source:'css'
    }
];

export default {
/**
 * 載入資源
 *
 * @param {Object<soruce:string,url:string>} ata
 * 
 * @return void
*/
loadResource:function(data){
    data.forEach(({source,url})=>{
        let canLoad = ['css','script'].indexOf(source) >= 0 ;
        if(!canLoad) return;

        if(source == 'css'){
            let style = window.document.createElement('link');
            style.type = "text/css";
            style.rel = "stylesheet";
            style.href = url;
            window.document.head.appendChild(style);    
        }else{
            let script = window.document.createElement('script');
            script.src = url ;
            window.document.append(script);
        }
    });
}
};