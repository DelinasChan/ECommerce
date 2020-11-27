<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request ;
use Illuminate\Http\Response ;
use Illuminate\Support\Facades\Log ;
use Symfony\Component\HttpFoundation\Cookie ;
// use App\Service\CartService ;

use App\Models\ProductModel ;


class CartController extends Controller
{

    /**
     * @param int page
     */
    public function products( Request $request )
    {      
        $perPage = 12 ;
        $query =$request->query();
        $page = isset( $query["page"] ) ? $query['page'] : 1 ;
        $paginator = ProductModel::orderBy('createdAt', 'DESC')->paginate( $perPage , ["*"] , "page" , $page ) ; 
        $lastPage = $paginator->lastPage()  ;
        $items = $paginator->items() ; $data = [] ;

        $cart = session()->get("cart") ;
        if( !$cart ){
            session()->put( "cart" , []);
        };

        foreach( $items as $item )
        {
            $item["attachments"] = json_decode( $item["attachments"] , false );
            $item["image"] = $item["attachments"][0] ; //精選圖
            $item["fold"] = floor( ( $item["discountPrice"] / $item["originalPrice"] ) * 100 ); //折數
            //檢查該商品是否在購物車中
            $item["inCart"] = isset( $cart[$item["id"]] );
            array_push( $data , $item );
        }
        // return $data ;
        return view( "front.home" , [ "lastPage" => $lastPage , "data" => $data ] );
    }

    public function readProduct( Request $request , $productId )
    {
       $Product = ProductModel::getProduct( $productId ) ;
       $Product->inCart = isset(  session()->get("cart")[ $Product->id ] );
       return view(" front.product " ,  [ "product" => $Product ]) ;
    }

    /**
     * @param productId - 要處理的商品 id
     * 
     */
    public function modifyCart( Request $request , $productId  )
    {

        //購物車 存在 session
        $cart = session()->get("cart");
        $data = $request->json()->all() ; 
        //購物車不存在 建立一台新的
        if( ! $cart ){
            $cart = [ $productId => [ "quantity" => 1] ] ;
        }else if( ! isset( $cart[ $productId ] ) ){
            //購物車查無此商品 預設數量為一 
            $cart[ $productId ] = [ "quantity" => 1 ] ;
        }else {
            if( !isset( $data["quantity"]  ) ){
                $data["quantity"] = 1 ;
            };
            //購物車存在 且有商品變更數量
            $cart[ $productId ] = [ "quantity" =>  $data["quantity"] ] ;
        };

        session()->put( 'cart' , $cart ) ;
        return response()->json( session()->get("cart") );

    }

    /** 從購物車 移除 */

    /** 查看購物車 */
    public function readCart( Request $request , $productId = null )
    {

        $cart = session()->get("cart");
        $keys = [] ;
        $total = 0 ;
        //查看購物車
        foreach( $cart as $key => $product ){
            array_push( $keys , $key );
        };

        //如果是刪除 根據 Array 位置 移除 key
        if( $request->isMethod('delete') ){
            $indexKey = array_search( $productId , $keys  );
            unset( $keys[ $indexKey] )   ; //從產品id 移除元素
            unset(  $cart[ $productId ] ); // 移除購物車 資料
            session()->put( "cart" , $cart );
        };

        $data = ProductModel::whereIn("id", $keys )->get();

        foreach( $data as $product )
        {
            $product["quantity"] = $cart[ $product["id"] ]["quantity"];
            $product["image"] = json_decode( $product["attachments"] )[0] ;
            $total += $product["quantity"] * $product["discountPrice"] ;
        };

        /** 移除商品 回傳 JSON資料 */
        $result =  [ "data" => $data , "total" => $total , "action" => $request->isMethod('delete') ] ;
        if( $request->isMethod('delete') ){
            return response()->json( $result);
        }else{
            // GET 回傳頁面 資料
            return view( "front.cart" , $result  );
        };

    }

}
