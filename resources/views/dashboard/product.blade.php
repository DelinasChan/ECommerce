@extends('template.dashboardMain')

@section("content")
    <!-- ProductFrom Start -->
    <form 
        id="productForm" method="POST"
        action="/dashboard/product/save"
    >
        @csrf

        <!-- 產品名稱 -->
        <div class="edit">
            <input 
                type="text" placeholder="產品名稱" 
                value="" name="name"
            >
        </div>

        <!-- 產品描述(summernote) -->
        <div class="edit">
            <textarea id="summernote" name="editordata"></textarea>
        </div>

        <!-- 詳細內容 -->
        <div class="detial edit">
            <div class="section-list">
                <a target="base"   >基礎資訊</a>
                <a target="gallery" >相關圖片</a>
            </div>
            <!-- 預設第一個 -->
            <div class="section-item">
                <section id="base"  class="selected" >
                    <div class="edit-block" >
                        <label>原價：</label>
                        <input type="number" name="originalPrice" value="0" />
                    </div>
                    <div class="edit-block">
                        <label>特價：</label>
                        <input type="number" name="discountPrice" value="0" />
                    </div>
                </section>
                <section id="gallery"  >
                    <!-- 圖片列表 -->

                    <!-- 新增圖片 -->
                    <div class="picture no-image openMediaBtn" callBack="galleryAddImage" >
                        &nbsp;
                    </div>
                    
                </section>
            </div>
        </div>
        
        <div >
            <input type="submit" value="提交表單" >
        </div>

    </form>
    <!-- ProductFrom End -->

    <script>

        $(document).ready(function() {

            /**  初始化文字編輯器 */
            let HelloButton = function (context) {
            let ui = $.summernote.ui;
            let button = ui.button({
                    contents: '<i class="fa fa-child openMediaBtn" callBack="editorAddImage" /> Hello',
                });
                
                return button.render(); 
            };

            $('#summernote').summernote({ 
                disableResizeEditor: true , lang:"zh-TW" ,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ["myBtn" , ["hello"]] 
                ],
                buttons: {
                    hello: HelloButton
                }

            });

            $(".section-list > a ").click(function( ){
                let selectId = $(this).attr("target") ;
                $(".section-item > section").each(function( index ){
                    if( selectId == $(this).attr("id") ) {
                        $(this).addClass( "selected" );
                    }else{
                        $(this).removeClass( "selected" );
                    };
                });
            });


            $("#productForm").submit(function( event ){
                let FormData = $(this).serializeArray() ;
                event.preventDefault()  ;
                console.log( FormData ) ;
                return false ;
            });

        });

    </script>
@stop