@section("title", "會員登入")

@include('template.header')

<div class="wrapper login">
    <form id="login" action="/member/login" method="POST" >
        
        @csrf 
        <a class="title">
            會員登入
        </a>
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

        <div class="third-party">
            <a href="/member/auth/facebook" class="fb-login">
                FaceBook Login
            </a>
        </div>

        <div>
            <a class="submit btn btn-light>">登入 </a>
            <a class="btn btn-light" href="/member/register">尚未註冊?</a>
        </div>

    </form>
</div>

<style>

#login{
    width:80% ;position:absolute ; 
    left:50% ; top:40% ;
    transform:translate( -50% , -50% );
    max-width:600px ; padding:10px ; 
    border:1px solid black ;
    border-radius:10px ;
    display:flex ; flex-direction:column ;
    justify-content:space-around ;
    min-height : 200px ;
}

#login > div{
    margin:25px auto ; text-align:center ;
    flex-basis:40px  ; width:35% ; min-width:350px ;
    align-items:center ; position:relative ;
}

#login > a.title {
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

#login input[ type=text ] {
    line-height:1.5 ; font-size:18px   ;
    outline:none    ; padding: 0 10px  ;
    width:100% ; 
}

input[type=text] a {
    pointer-events : none ;
}

#login input[ type=text ]:valid ~ a ,
#login input[ type=text ]:focus ~ a {
    top:-15px ; left:2px ; font-size:8px ;
    color:green ;
}

#login > div:last-child {
    display:flex ; justify-content:space-around ;
}

#login > div:last-child > a {
    display:inline-block ; padding: 0 15px ;
    line-height:2.3 ; color: #3ea7a7   ;
    cursor:pointer ; border-radius:5px ;
    border: 1px solid #3ea7a7 ;
    text-decoration:none ;
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

.fb-login{
    display:block ;
    width:80% ;
    margin: 0 auto ;
    line-height: 2 ;
    background:#3ed2ffed ;
    color:#fff ;
    font-size:18px ;
    /* font-family: */
    text-decoration:none ;
    
}


</style>

<script>

    $(document).ready( function(){

        $("a.submit").click(function(){
            
            let url = $("form#login").attr("action") ;
            let method = $("form#login").attr("method") ;
            let fm  = new FormData();
            let headers = { } ;
            $("form#login").serializeArray().forEach(({ name , value }) =>{
                fm.append( name , value ) ;
            });

            fetch(  url , { method , body:fm } )
                .then(( res ) => res.json() )
                .then(( data ) =>{
                    
                    alert( data.message );
                    
                    //登入成功 重導向到首頁 ...
                    if( data.status ){
                        location.href = "/" ;
                    };

                });

        });

    });
</script>


@include('template.footer')
