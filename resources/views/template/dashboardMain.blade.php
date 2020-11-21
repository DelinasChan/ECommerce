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

</head>
<body>
    <div class="dashboard">
        
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
            <div id="darkBox" class="media-library" show="true" >
                <div class="render">
                    <div class="title">
                        <a>媒體庫</a>
                    </div>
                    <div class="content">
                        <div class="left">
                            <!-- 圖片列表 -->
                        </div>
                        <div class="right">
                            <div 
                                class="edit-block"
                                action="alt"    
                            >
                                <label>
                                    <a>替代文字：</a>
                                    <input type="" />
                                </label>
                            </div>
                            <div class="edit-block">
                                <label>
                                    <a>替代文字：</a>
                                    <input type="" />
                                </label>
                            </div>
                            <div class="edit-block">
                                <label>
                                    <a>替代文字：</a>
                                    <input type="" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- MediaLib End -->
        
        <script>
            $("#darkBox").click(function(){
               let show =  $(this).attr("show") ;
            //    $(this).attr( "show" , !show ) ;
            });
        </script>

    </div>
</body>
</html>