<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MediaModel ;
use App\Models\ProductModel ;

/** 後台控制器 */
class DashboardController extends Controller
{

    /** 產品列表 */
    public function products()
    {
        return view("dashboard.products") ;
    }

    /** 根據有無 productId 判斷是 編輯或建立 */
    public function product( Request $request , $productId = null  )
    {
        //有 id 就是編輯
        if( $productId > 0 ){  
            //根據 Model 抓 Product 
            $Product = ProductModel::getProduct( $productId ) ;
            return response()->json( $Product ) ;
        } ;
        return view("dashboard.product")->with( [ "productId" => $productId ]); ;
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
        //序列化附加圖片
        $attachments = $InsertProduct["attachments"]  ;
        $InsertProduct["attachments"] = json_encode( $attachments );
        $Product = ProductModel::Create( $InsertProduct ) ;
        return  response()->json( $Product ) ;
    }
    
    /** 取得用戶Id 取得媒體庫資料 */
    public function getMedia()
    {
        return MediaModel::where( 'memberId' , '=' , 1 )->get() ;
    }

    /** 根據圖片資源 */
    public function updateMedia( Request $request )
    {

        $id = $request->get("id")   ;
        $alt = $request->get("alt") ;
        MediaModel::where( 'id' , '=' , $id  )->update([ "alt" => $alt ]);
        return response()->json([ "status" => true ]);
    }

}
