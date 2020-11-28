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
                <div class="right" >
                    @if(Session::has('user'))
                        <a href="/dashboard/products" >
                            進入後台
                        </a>
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

    <script src="{{ URL::asset('/js/app.js') }}"></script>
    <script>



        $(document).ready(function(){

            $("a[active]").click( function(){

                let active = $(this).attr("active") ;
                let productId = $( this ).attr( "productId" ) ;
                let url = `/shop/modifyCart/${ productId }`   ; 
                if( active == "inCart" ){
                    //從購物車移除
                    fetch( url ,{ method:"DELETE" })
                    .then((res) => res.json() )
                    .then(({ data , total }) => {
                        if( $("#shop-cart").length > 0 ){
                            $(`div[productId=${ productId }]`).remove();
                            if(  $("div[productId]").length == 0 ) {
                                alert("購物車已清空");
                                location.href = "/";
                            };
                            $("#total").attr("value" , total )    ;
                            $("#total").text( `總計:${ total }` ) ;
                        }else{
                            $(`a[productId=${ productId }]`).attr("active" , "addCart");
                            $(`a[productId=${ productId }]`).text("加入購物車");
                        };
                    });
                } else {
                    //新增至購物車
                     fetch( url  , { method:"POST" })
                        .then(()=>{
                            $(`a[productId=${ productId }]`).attr("active" , "inCart");
                            $(`a[productId=${ productId }]`).text("已在購物車");
                        });
                };

            });

        });
    </script>
</body>
</html>