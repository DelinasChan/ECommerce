@extends('template.frontPage')

@section("content")
    <!-- Display Products Start -->
    <div class="products ">
        <div class="title">
            <a>熱門商品</a>
        </div>

        <div class="product-list">
            @foreach( $data as $product )
                <div class="product" pId="{{ $product->id }}">
                    <!-- 折扣數 -->
                    <a class="disocunt"  >現省{{ $product->fold }}折</a>
                    <!-- 圖片-->
                    <div class="preview">
                        <img src="{{ $product->image->src }}" width=50 height=50 />
                    </div>

                    <div class="info">
                        <div>
                            <a >{{ $product->name }}</a>
                        </div>
                        <div class="detial">
                            <a style="text-decoration:line-through;color:red;" >
                                <i>{{ $product->originalPrice }}</i>
                            </a>
                            <a>{{ $product->discountPrice }}</a>
                        </div>
                        <div class="shop">
                            <a href="/product/{{ $product->id }}" >
                                查看商品
                            </a>
                            @if( $product->inCart )
                                <a  productId="{{ $product->id }}" active="inCart" >
                                    已在購物車中
                                </a>
                            @else
                                <a productId="{{ $product->id }}" active="addCart" >
                                    加入購物車
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagin-btns">
            @for( $page = 1 ; $page <= $lastPage ; $page++ )
                <a 
                    href="/?page={{ $page }}"  
                    @if( request()->get('page') == $page )
                        class="active"
                    @elseif( ! request()->get('page') && $page == 1  )
                        class="active"
                    @endif
                >
                    {{ $page }}
                </a>
            @endfor 

        </div>
    </div>
    <!-- Display Products End -->
@stop