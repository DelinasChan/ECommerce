<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MediaModel ;
use App\Models\ProductModel ;
use App\Models\OrderModel ;

// use App\Service\DashboardService ;

/** 後台控制器 */
class DashboardController extends Controller
{
    /** 取得歷史訂單 */
    public function orders( Request $request )
    {
        $querystring = $request->query() ;
        $page = isset( $querystring["page"] ) ?  $querystring["page"] : 1 ;
        $result = OrderModel::readOrders(  $page ) ;
        return response()->json( $result );
    }

    /** 移除產品 */
    public function delProduct( Request $request , $productId )
    {   
        if( $productId ){
            ProductModel::destroy( $productId );
        } ;
        return response()->json([ "status" => true ]);
    }

    /** 
     * 分頁查詢產品產品列表  
     * 
     * @param Int page 
     * @return View(  data<Array<Product> >, lastPage> )
    */
    public function products( Request $request )
    {   
        $querystring = $request->query() ;
        $page = isset( $querystring["page"] ) ? $querystring["page"] : 1 ;
        $result = ProductModel::getProducts( $page , true , 10 );
        foreach( $result["data"] as $key => $product )
        {
            $result["data"][$key]["image"] = $product->image ; //設定 image
        };
        return response()->json( $result );
    }

    /** 根據有無 productId 判斷是 編輯或建立 */
    public function product( Request $request , $productId = null  )
    {   
        // 從Model 抓 Product 
        $Product = ProductModel::find( $productId ) ;
        // 查無商品 重導向到建立商品
        if( ! isset( $Product->id ) &&  $productId > 0 ){  
            return redirect("dashboard/product/create") ;
        } ;
        return view("dashboard.product")->with( [ "productId" => $productId , "product" => $Product ]);
    }

    /** 
     * 
     * @method POST
     * @param Int productId - 產品Id 有代表要更新產品 
     * @param Object request - FormData
     * 
    */
    public function saveProduct( Request $request , $productId = null )
    {   
    
        $InsertProduct = $request->json()->all() ;

        //附加圖片序列化成 JSON 字串
        $attachments = $InsertProduct["attachments"]  ;
        $InsertProduct["attachments"] = json_encode( $attachments ) ;

        if( $productId ){
            //有Id 代表更新產品
            ProductModel::where( "id" , "=" , $productId )->update( $InsertProduct ) ;
        }else{
            $InsertProduct["memberId"] = session()->get("user")["id"] ;
            $Product = ProductModel::Create( $InsertProduct ) ;
        };


        return  response()->json([ "status" => true ]) ;

    }
    
    /** 取得用戶Id 取得媒體庫資料 */
    public function getMedia()
    {   
        return MediaModel::where( 'memberId' , '=' , session()->get("user")["id"] )->get() ;
    }

    /** 根據圖片資源 */
    public function updateMedia( Request $request )
    {

        $id = $request->get("id")   ;
        $alt = $request->get("alt") ;
        MediaModel::where( 'id' , '=' , $id  )->update([ "alt" => $alt ]);
        return response()->json([ "status" => true ]);
    }

    /** 查看歷史訂單 */


}
