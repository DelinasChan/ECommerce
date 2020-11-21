<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $Product = [ "name" ];
        if( $productId > 0 ){  
            //根據 Model 抓 Product 
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
    public function saveProduct( Request $requrest , $productId )
    {
        return view("dashboard.product")->with(["productId"=> $productId ]);
    }

}
