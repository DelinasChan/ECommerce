@section("title", "會員註冊")

@include('template.header')

<div class="wrapper register">
    <form id="register" action="/member/register" method="POST" >
        
        @csrf 
        <a class="title">
            會員註冊
        </a>

        <div class="input-container">
            <input type="text" name="username" value="" required />
            <a>姓名</a>
            <div class="error-text" error="false" ></div>
        </div>
        <div class="input-container">
            <input type="text" name="account" value="" required />
            <a>帳號</a>
            <div class="error-text" error="false" ></div>
        </div>
        <div class="input-container">
            <input type="text" name="password" value="" required />
            <a>密碼</a>
            <div class="error-text" error="false" ></div>
        </div>
        <div class="input-container">
            <input type="text" name="email" value="" required />
            <a>信箱</a>
            <div class="error-text" error="false" ></div>
        </div>

        <div class="valide-code">
            <img 
                src="{{captcha_src()}}"
                onclick="this.src='{{ captcha_src() }}'+Math.random()"
            >
            <input name="validCode" type="text" >
            <div class="error-text" error="false" ></div>
        </div>

        <div>
            <a class="submit btn btn-light>">確認送出 </a>
            <a class="btn btn-light" href="/member/login">已有帳號</a>
        </div>
    </form>
</div>

<style>

#register{
    position:absolute ;
    left:50% ; top:40%;
    transform:translate( -50% , -50% );
    max-width:600px ; padding:10px ;
    border:1px solid black ;
    border-radius:10px ;
    width:80% ; display:flex ; 
    flex-direction:column ;
    justify-content:space-around ;
    height:60% ;
}

#register > div{
    margin:20px auto 0 auto ; text-align:center ;
    flex-basis:40px  ; width:35% ; min-width:350px ;
    align-items:center ; position:relative ;
}

#register > a.title {
    display: block ; text-align : center ;
    font-size:35px ; font-weight:1000px ;
    border-bottom:1px solid black  ;
    text-decoration:none ; color:black ; 
}

.input-container > a {
    position:absolute ;
    top:40% ; left:3% ;
    transform:translateY(-50% ) ;
    transition: all .3s ;
}

#register input[ type=text ] {
    line-height:1.5 ; font-size:18px   ;
    outline:none    ; padding: 0 10px  ;
    width:100% ; 
}

#register input[ type=text ]:valid ~ a ,
#register input[ type=text ]:focus ~ a {
    top:-15px ; left:2px ; font-size:8px ;
    color:green ;
}

#register > div:last-child {
    display:flex ; justify-content:space-around ;
}

#register > div:last-child > a {
    display:inline-block ; padding: 0 15px ;
    line-height:2.3 ; color: #3ea7a7   ;
    cursor:pointer ; border-radius:5px ;
    border: 1px solid #3ea7a7 ;
    text-decoration:none ;
}

.valide-code{
    display:flex ; justify-content:space-around ;
}

.valide-code input{
    flex-basis: 150px ;
}

.error-text {
    width: 80% ; background: #e2828252 ;
    position: absolute ; top: 85% ; right: -7%;
    color: red ; font-size: 15px ;
    line-height: 1.5 ; border-radius: 5px; 
    transform:translateY( 50% );

    display:none ;
}

.error-text[error=true]{
    display:block ;
}


</style>

<script>

    $(document).ready( function(){

        $("a.submit").click(function(){
            
            let url = $("form#register").attr("action") ;
            let method = $("form#register").attr("method") ;
            let fm  = new FormData();
            let headers = { } ;
            $("form#register").serializeArray().forEach(({ name , value }) =>{
                fm.append( name , value ) ;
            });

            fetch(  url , { method , body:fm } )
                .then(( res ) => res.json() )
                .then(( data ) =>{
                    
                    $("input ~ .error-text").each(( index , el )=>{
                        $(el).attr("error","false");
                    });
                    if( data.errors ){
                        $(".valide-code > img").attr("src" , "{{ captcha_src() }}" + Math.random())
                        Object.entries( data.errors ).
                            forEach(([ key , [ value ]]) => {
                                let selector = `input[name=${key}] ~ .error-text` ;
                                $(selector).text( value );
                                $(selector).attr("error","true");
                            });
                        return false ;
                    };

                    alert("註冊成功!");
                    window.location.reload() ;

                })

        });

    });
</script>


@include('template.footer')
