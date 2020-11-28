@extends('template.frontPage')

@section("content")
    <div id="shop-cart">

        <div class="products">
            @foreach( $data as $product )
                <div class="product" productId="{{ $product->id }}">

                    <div class="image">
                        <img 
                            src="{{ $product->image->src }}" 
                            width="50" height=100 
                        />
                    </div>

                    <div class="name">
                        <a>{{ $product->name }}</a>
                    </div>

                    <div class="quantity">
                        <input 
                            type="number" value="{{ $product->quantity }}" 
                            id="quantity" price="{{ $product->discountPrice }}"
                            productId="{{ $product->id }}"
                        />
                    </div>

                    <div class="price">
                        <a>{{ $product->discountPrice }}</a>
                    </div>

                    <div >
                        <a active="inCart" productId="{{ $product->id }}" >
                            移除
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

        <div class="checkArea">
            <a id="total" value="{{ $total }}" >總計：{{ $total }}</a>
            <a active="buyNow" href="/ecpay/payNow" >立即購買</a>
        </div>

    </div>

    <script>
        

        $( document ).ready(function(){

            if( $("div.product").length == 0 ){
                alert("當前購物車無商品...");
                location.href = "/" ;
                return false ; 
            };

            $("input#quantity").change(function( event ){
                
                let price = $(this).attr("price")          ;
                let productId =  $(this).attr("productId") ;
                let { value:quantity }= event.target       ;
                //單價 * 數量
                let config = { method:"POST" , body:JSON.stringify({ quantity:parseInt( quantity ) }) };
                fetch(`/shop/modifyCart/${productId}` , config )
                    .then(( res ) =>  res.json())
                    .then(( data ) =>{
                        //變更成功 重新計算 total 
                        let total = 0 ;
                        $("input#quantity").each( function( index , el ){
                            let quantity = $(el).val();
                            let price = $(this).attr("price")  ;
                            total += quantity * price ;
                        });

                        $("#total").attr("value" , total );
                        $("#total").text( `總計:${ total }` );

                    });

            });

        });

    </script>
@stop