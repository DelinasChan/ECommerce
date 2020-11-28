@extends('template.dashboardMain')

@section("content")
    <!-- ProductFrom Start -->
    <form 
        id="productForm" method="POST"
        @if( $productId > 0 )
            action= "/dashboard/product/save/{{ $productId }}"
        @else
            action= "/dashboard/product/save"
        @endIf
    >
        @csrf

        <!-- 產品名稱 -->
        <div class="edit" name="name" label="產品名稱">
            <input 
                type="text" placeholder="產品名稱" 
                value="{{ $product->name ?? '' }}" name="name"
            >
        </div>

        <!-- 產品描述(summernote) -->
        <div class="edit">
            <textarea id="summernote" name="introduce" label="產品描述" >
            {{ $product->introduce ?? '' }}
            </textarea>
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
                    <div class="edit-block" label="特價" name="originalPrice" >
                        <label>原價：</label>
                        <input 
                            type="number" name="originalPrice" 
                            value="{{ $product->originalPrice ?? '' }}" 
                        />
                    </div>
                    <div class="edit-block" label="特價" name="discountPrice" >
                        <label>特價：</label>
                        <input 
                            type="number" name="discountPrice" 
                            value="{{ $product->discountPrice ?? '' }}" 
                        />
                    </div>
                </section>

                <section id="gallery" label="相關圖片" name="attachments" >

                    <!-- 圖片列表 -->
                    @if( $product )
                        @foreach( $product->thumbnail as $key=>$attach )
                            <div class="preview picture" index="{{ $key + 1 }}">
                                <input type="hidden" name="preview[]" value="{{ $attach->value }}">
                                <img src="{{ $attach->src }}" alt="{{ $attach->alt }}" height="80" width="150">
                                <a 
                                    onclick="delImage( this )" 
                                    index ="{{ $key + 1 }}"
                                >
                                    x
                                </a>
                            </div>
                        @endforeach
                    @endif


                    <!-- 新增圖片按鈕 -->
                    <div class="picture no-image openMediaBtn" callBack="galleryAddImage" >
                        &nbsp;
                    </div>
                    
                </section>
            </div>
        </div>

        <div>
            <input 
                type="submit" value="{{ $productId > 0 ? '修改' : '建立' }}" 
            />
        </div>

    </form>
    <!-- ProductFrom End -->

    <script>

        $(document).ready(function() {

            /**  初始化文字編輯器 */
            let MediaBotton = function (context) {
            let ui = $.summernote.ui;
            let button = ui.button({
                    contents: '<i class="fa fa-child openMediaBtn" callBack="editorAddImage" />媒體庫',
                });
                
                return button.render(); 
            };

            $('#summernote').summernote({ 
                disableResizeEditor: true , lang:"zh-TW" ,
                toolbar: [
                    // [groupName, [list of button]]
                    [ 'style' , ['bold', 'italic', 'underline', 'clear']],
                    [ 'font'  , ['strikethrough', 'superscript', 'subscript']],
                    [ 'fontsize', ['fontsize']],
                    [ 'color' , [ 'color' ] ],
                    [ 'para', [ 'ul', 'ol', 'paragraph' ] ],
                    [ 'height', [ 'height' ] ] ,
                    [ "media" , [ "media"  ] ] 
                ],
                buttons: { 
                    media: MediaBotton
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

                let SubmitForm = $(this).serializeArray() ;
                let requestUrl =   $(this).attr("action") ;
                
                event.preventDefault()  ;

                //檢查表單 
                let emptyError = SubmitForm.filter(({ value })=> !value)
                                    .map(({ name })=>  $(`[name=${name}]`).attr("label") );
                
                if( $("input[name='preview[]'").length == 0 ){
                    emptyError.push("相關圖片");
                };

                if( emptyError.length > 0 ){
                    alert( emptyError.join("\n") + "\n 尚未填寫" );
                    return false ;
                };

                let discountPrice = $("input[name=discountPrice]").val();
                let originalPrice =  $("input[name=originalPrice]").val();
                if( ( discountPrice - originalPrice ) > 0 ){
                    alert("特價不能大於原價");
                    return false ;
                }

                let attachments = SubmitForm.filter(({ name }) => name == "preview[]" )
                                    .map(({ value } , index ) => JSON.parse( value ) ) ;

                //設定產品資料 & token
                let token = $("input[name='_token']").val() ;
                let headers = { 'X-CSRF-TOKEN':token ,     contentType: 'application/json; charset=UTF-8' };
                let data = { attachments } , excludeName = [ "preview[]" , "_token" ];
                SubmitForm.forEach(({ name , value })=>{
                    if( excludeName.indexOf(name) == -1 ) { data[ name ] = value ; };
                });
                
                fetch( requestUrl , { method:"POST" , body:JSON.stringify( data ), headers } )
                    .then(( res  ) => res.json() )
                    .then(( data ) => { if( data.status ){ location.reload(); }; });

            });

        });

        function delImage( element )
        {   
            let index    = $( element ).attr("index")  ;
            let selector = `div[index=${ index }]` ;
            $( selector ).remove();

            let eachElement = document.querySelectorAll("#gallery > .preview") ;
            $("#gallery > .preview").each(( index , el )=>{
                $( el ).attr("index" , index + 1) ;
                $(el).children("a").attr("index" , index + 1) ;
            });

        };

    </script>
@stop