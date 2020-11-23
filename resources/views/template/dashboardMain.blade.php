<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理後台-{{ $productId ? 'XXX產品' : '新增商品' }}</title>

    <!-- 引用本地CSS -->
    <link href="{{ URL::asset('/css/dashboard.css') }}" rel="stylesheet">

    <!-- 從CDN 引用 BS & jQuery -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- 後台引用 summernote 樣式 & JS -->
    <link href="{{ URL::asset('/js/summernote/summernote-lite.min.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('/js/summernote/summernote-lite.min.js') }}" ></script>
    <script src="{{ URL::asset('/js/summernote/lang/summernote-zh-TW.min.js') }}" ></script>

    <script>
        
        window.DarkBox = {
            open:() => { $("#darkBox").attr( "show" , "true" ) ;   },
            close:() => { $("#darkBox").attr( "show" , "false" ) ; }
        };

        window.MediaLibrary = class MediaLibrary{
            static callBack = null ;

            /** callBack 設定要操作的 DOM */
            static setCallBack( callBack ){  
                this.callBack = callBack ;
                DarkBox.open();
            };

            //媒體庫呼叫事件
            static insertImage( image ){
                if( typeof this.callBack == "function" ){
                    this.callBack( image );
                    this.callBack = null  ;
                    DarkBox.close();
                };
            };
        };

    </script>
</head>
<body>
    <div  class="dashboard">
        <!-- SideBar Start -->
            <div class="sideBar">
                <ul>
                    <li class="list" >
                        <a>產品</a>
                        <ul class="sub" >
                            <li> <a href="/dashboard/products"> 產品列表 </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"> 編輯資料 </a>
                    </li>
                </ul>
            </div>       
        <!-- SideBar End   -->

        <!-- Content Start -->
            <div class="content">
                @yield('content')
            </div>
        <!-- Content End   -->

        <!-- 媒體庫 MediaLib Start -->
            <div id="darkBox" class="media-library" show="false" >
                <media-library></media-library>
            </div>
        <!-- MediaLib End -->
        
        <script>

            let ImageCallBack = {
                galleryAddImage:({ src , alt })=>{
                    
                    let value = JSON.stringify({ src , alt }) ;
                    let total = $("div.preview").length ;
                    let index = total + 1 ;
                    let insertHtml = `
                        <div class='preview picture' index=${ index } >
                            <input type="hidden" name=preview[] value=${value} />
                            <img 
                                src='${ src }' alt='${ alt }' 
                                height=80 width=150    
                            />
                            <a onclick='delImage(${ index })'  >x</a>
                        </div>
                    `;
                    $( insertHtml ).insertBefore("div.no-image.openMediaBtn");
                },
                /** 插入文字編輯器 CallBack */
                editorAddImage:({ src , alt }) => {

                    let HtmlContent =  $('#summernote').summernote("code");
                    let insertHtml  = `
                        <div style='margin:8px auto ;' >
                            <img 
                                src='${ src }' alt='${ alt }'
                                width=450 height=300 
                            />
                        </div>` ;
                    let code =  HtmlContent + insertHtml ;
                    $('#summernote').summernote( "code" , code );

                }
            };
            
            $(document).ready(function() {

                $(".openMediaBtn").click(function(){ 
                    let callBackName = $(this).attr("callBack") ;
                    MediaLibrary.setCallBack( ImageCallBack[ callBackName ]  );
                }) ;



            });


            document.addEventListener("click", function( event ){
                if( event.target.id == "darkBox" ){ DarkBox.close(); };
            });

        </script>

        <script src="{{ mix('js/app.js') }}"></script>

    </div>
</body>
</html>