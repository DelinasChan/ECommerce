<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @if(View::hasSection("title"))
    <title>@yield("title")</title>
    @else
     <title>Easy Shop 購物的好網站</title>
    @endif

    <link href="{{ URL::asset('/css/frontPage.css') }}" rel="stylesheet">

    <!-- 從CDN 引用 jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


</head>
<body>
    
    <div class="outermost">

        <!--- NavBar Start -->
        <div class="navbar">

            <!-- Left  Home -->
            <a href="/" class="goHome" >回首頁</a>

            <!-- Right Cart , logIn -->
            <div class="item-container">
                <div>
                <a 
                    class="icon cart"
                    href="/shop/cart"
                >
                    &nbsp;
                </a>
                </div>
                <div>
                    @if(Session::has('user'))
                        <a href="/member/logout" > LogOut </a>
                    @else
                        <a href="/member/login" > Login </a>
                    @endif

                </div>
                
            </div>
        </div>
        <!--- NavBar End -->

        <!-- 主要內容區塊 -->
        <div class="content-wrapper">
            @yield("content")
        </div>

        <!-- Footer Start -->
        <div class="footer">
            <a> CopyRight @By-Delinas </a>
        </div>
        <!-- Footer End -->

    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        $(document).ready(function(){

            /** Ajax 添加移除購物車項目 */
            $("a[active=addCart]").click(function(){
               let productId = $( this ).attr( "productId" );
                fetch(`/shop/modifyCart/${ productId }` , { method:"POST" })
                    .then(()=>{
                        $(`.shop a[productId=${ productId }]`).attr("active","inCart");
                    })
            });
            
            $("a[active=inCart]").click(function(){
                let productId = $(this).attr("productId");
                let url =  `/shop/modifyCart/${productId}` ;
                fetch( url ,{ method:"DELETE" })
                    .then((res) => res.json() )
                    .then(({ data , total }) => {
                        console.log( $(this) )
                        if( $("#shop-cart") ){
                            $(`div[productId=${ productId }]`).remove();
                            $("#total").attr("value" , total )    ;
                            $("#total").text( `總計:${ total }` ) ;
                        }else{
                            $(this).attr("active","addCart");
                        };

                    });
                })

        });
    </script>
</body>
</html>