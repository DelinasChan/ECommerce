<?php

namespace App\Service ;

use Illuminate\Support\Facades\Hash;

use App\Models\ProductModel ;
use App\Models\OrderModel ;
use App\Models\OrderItemModel ;


class CartService{

    /** 取得購物車資料 */
    function getCart()
    {
        /** 從 session 取得購物車資料 */
        $cart = session()->get("cart") ;
        $keys  = [] ;
        $total =  0 ;

        //查看購物車
        foreach( $cart as $key => $product ){ array_push( $keys , $key ); };

        /** 取得 ProductId */
        $data = ProductModel::whereIn( "id", $keys )->get();

        foreach( $data as $product )
        {
            $product["quantity"] = $cart[ $product["id"] ]["quantity"];
            $product["image"] = json_decode( $product["attachments"] )[0] ;
            $total += $product["quantity"] * $product["discountPrice"] ;
        };

        return [ "data" => $data , "total" => $total ] ;

    }

    public function createOrder()
    {

        $cart = $this->getCart() ;
        $data = $cart["data"]    ;
        $total = $cart["total"]  ;
        
        /** 隨機20碼單訂單 id */
        $memberId = session()->get("user")["id"];

        //根據 Order.id 判斷訂單編號是否重複 不重複才建立訂單
        do{
            preg_match( "/[0-9A-Za-z]{20}/" , Hash::make(time()) , $matchStr ); 
            $orderId = strtoupper( implode ( $matchStr ) );
            $Order   = OrderModel::where("id" , "=" , $orderId )->first() ;
        }while( $Order && ( count( $orderId ) == 20 ) );

        $Order = [ "id" => $orderId , "memberId" => $memberId ];
        $insertItem = [] ;
        $sendItem = [] ; //送到綠界訂單資料
        foreach( $data as $Product )
        {

            $Item = [ 
                "productId" => $Product->id , "price" => $Product->discountPrice ,
                "quant"     => $Product->quantity , "orderId" => $orderId ,
                "productName" => $Product->name
            ];

            array_push( $insertItem , $Item );
            array_push( $sendItem , array(
                'Name' => $Product->name, 'Price' => $Product->discountPrice  ,
                'Currency' => "NT", 'Quantity' => $Product->quantity , 
                'URL' => "http://localhost/product" . $Product->id 
            ) ) ;

        };

        OrderModel::create( $Order );
        OrderItemModel::insert( $insertItem );
        return [ "tradeNo" => $orderId , "total" => $total , "sendItem" => $sendItem ] ;

    }

    public function setPayResult( $payResult )
    {
        $id = $payResult["MerchantTradeNo"]  ;
        $status = $payResult["RtnCode"] == 1 ;
        $changeData = [
            "ecPay_tradeNo" => $payResult["TradeNo"] ,
            "payStatus"     => $status ? "SUCCESS" : "FAILED"
        ];
        OrderModel::where("id" , "=" , $id )->update( $changeData );
        return $status ;

    }

    /**
     * 根據訂單編號 查詢購買者
     */
    public function getCustomer( $TradeNo )
    {
        return OrderModel::where("id" , "=" , $TradeNo )->first()->member;
    }

}
