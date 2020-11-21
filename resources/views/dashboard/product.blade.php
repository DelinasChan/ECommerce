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
                    <div class="picture no-image">
                        <img height=130 />
                    </div>
                </section>
            </div>
        </div>
        
        <div >

        </div>

    </form>
    <!-- ProductFrom End -->

    <script>
        $(document).ready(function() {

            /**  初始化文字編輯器 */
            $('#summernote').summernote({
                disableResizeEditor: true ,
                lang:"zh-TW"
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
        });
    </script>
@stop