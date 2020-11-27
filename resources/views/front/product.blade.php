@extends('template.frontPage')

@section("title", $product->name )

@section("content")
    <!-- Display Products Start -->
    <div class="product-page">
        <div class="baseInfo">
            <div class="left" >
                
                <div class="preview">
                    <img 
                        src="{{ $product->attachments[0]->src }}"
                    />
                </div>
                <div class="gallery">
                    @foreach(  $product->attachments as $attach )
                        <a
                            src="{{ $attach->src }}"
                        >
                            <img 
                                src="{{ $attach->src }}" alt="{{ $attach->alt }}" 
                                width=80 height=120
                            />
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="right" >
                <div class="share">
                    <!--  Line --->
                    <div 
                        class="line-it-button" data-lang="zh_Hant" data-type="share-a" data-ver="3" data-color="default"
                        data-url="http://localhost/product/{{ $product->id }}"  
                        data-size="small" data-count="false" style="display: none;">
                    </div>
                    <script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>

                    <!-- Facebook  -->
                    <div 
                        class="fb-share-button"data-layout="button" data-size="small"
                        data-href="http://localhost/product/{{ $product->id }}" 
                    >
                        <a  
                            target="_blank" class="fb-xfbml-parse-ignore"                        
                            href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" 
                            >
                        分享</a>
                    </div>
                </div>
                <div>
                    <a class="productName" >{{ $product->name }}</a>
                </div>
                <div class="price" >
                    <p class="originalPrice" >原價:<i>{{ $product->originalPrice }}</i></p>
                    <p class="discountPrice">促銷價：<b style="color:red" >{{  $product->discountPrice }}</b></p>
                </div>

                <div>
                    @if( $product->inCart )
                        <a  productId="{{ $product->id }}" active="inCart" > 已在購物車中
                        </a>
                    @else
                        <a productId="{{ $product->id }}" active="addCart" > 加入購物車 </a>
                    @endif
                </div>

            </div>
        </div>
        <div class="detail">
            <div class="section">
                <a>產品介紹</a>
            </div>
            <div class="introduce">
                {!! $product->introduce !!}
            </div>
        </div>
    </div>
    <!-- Display Products End -->


    <script>

        $(document).ready(function(){
            $(" .gallery >a ").click(function(){
                let src = $(this).attr("src") ;
                $(".preview img").attr( "src" , src ) ;
            });
        });

    </script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v9.0&appId=362577801628402&autoLogAppEvents=1" nonce="E7tE0llW"></script>

@stop
