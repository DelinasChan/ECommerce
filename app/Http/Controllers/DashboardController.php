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
        // return view("dashboard.products") ;
        $paginator = ProductModel::where("memberId" , "=" , 0)->paginate( 2 ) ; 
        $paginator->items();
        // dd(  $paginator->items() );
        return response()->json(  $paginator ) ;

    }

    /** 根據有無 productId 判斷是 編輯或建立 */
    public function product( Request $request , $productId = null  )
    {   

        // 從Model 抓 Product 
        $Product = ProductModel::getProduct( $productId ) ;
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
            $Product = ProductModel::Create( $InsertProduct ) ;
        };

        return  response()->json([ "status" => true ]) ;

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
