<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request ;
use Illuminate\Http\Response ;
use Illuminate\Support\Facades\Log ;
use Symfony\Component\HttpFoundation\Cookie ;
use App\Service\CartService ;

class CartController extends Controller
{


    public function __construct( CartService $cartService  )
    {

        $this->cartService = $cartService ;

    }

    /**
     * 購物車資料 存在Session
     * @param Array<id,quantity> $postData - productId 及 購買數量
    */
    public function modifyItem( Request $request )
    {   

        //前端POST SESSION 資料

        //檢查是否有紀錄訂單號碼
        $sVal = session("sKey") ;

        if(  isset( $sVal )  )
        {
            dd( [ "sVal" => $sVal ] );

        }else{
            // $cookie = cookie('key', 'value', 2 );
            session([ 'sKey' => time() ]);
            return response("CREAT") ;
        };    
        

    }

}
