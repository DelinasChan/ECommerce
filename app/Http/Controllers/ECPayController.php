<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ECPayController extends Controller
{

    public function test()
    {

        $obj=new \ECPay_AllInOne();

        $obj->ServiceURL  = "https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5"; 
        $obj->HashKey     =  config("ecpay.HashKey") ;                                   
        $obj->HashIV      =  config("ecpay.HashIv") ;                                    
        $obj->MerchantID  =  config("ecpay.MerchantId" );                                
        $obj->EncryptType = '1';                                                         


        //基本參數(請依系統規劃自行調整)
        $MerchantTradeNo = substr( hash("md5" , time() ) , 0 , 10 ) ;
        $obj->Send['ReturnURL']         = config("ecpay.ReturnUrl");    //付款完成 post 到 server 做後續處理
        $obj->Send["OrderResultURL"]    = config("ecpay.OrderResultURL"); //付款完成後 客戶端重導向網址
        $obj->Send['MerchantTradeNo']   = $MerchantTradeNo;                          
        $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                       
        $obj->Send['TotalAmount']       = 2000;                                      
        $obj->Send['TradeDesc']         = "good to drink" ;   //產品描述 總金額                        
        $obj->Send['ChoosePayment']     = \ECPay_PaymentMethod::ALL ;                 
        
        $itemData = [
            'Name' => "歐付寶黑芝麻豆漿", 'Price' => (int)"2000",
            'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed"
        ];
        
        /** 商品資料  */
        array_push( $obj->Send['Items'] , $itemData );
        $obj->CheckOut();

    }

    /** 重導向後 客戶看到結果畫面 */
    public function clientResult( Request $req )
    {
        dd( $req ) ;
        return "客戶端";
    }

}
