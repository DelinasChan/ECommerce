<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request ;
use App\Service\CartService ;

class ECPayController extends Controller
{

    public function __construct( CartService $cart)
    {
        $this->cart = $cart ;
    }

    /** 
     * 立即購買 必須登入才可操作 根據session  建立訂單 
     * @param Array< productId , quantity > orderItem
     * 
     * */
    public function payNow( Request $request )
    {

        /** 建立訂單取得訂單編號 及總金額 */
        $orderInfo =  $this->cart->createOrder() ;
        // dd(  $orderInfo["sendItem"] );
        // return false ;
        $obj=new \ECPay_AllInOne();

        $obj->ServiceURL  = "https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5"; 
        $obj->HashKey     =  config("ecpay.HashKey") ;                                   
        $obj->HashIV      =  config("ecpay.HashIv") ;                                    
        $obj->MerchantID  =  config("ecpay.MerchantId" );                                
        $obj->EncryptType = '1';                                                         
        
        //訂單號碼當前時間做 MD5 加密 取前十碼轉大寫

        $obj->Send['ReturnURL']         = config("ecpay.ReturnUrl");    //伺服器接收 POST callBack 網址
        $obj->Send["OrderResultURL"]    = config("ecpay.OrderResultURL"); //付款完成後 客戶端重導向網址
        $obj->Send['MerchantTradeNo']   = $orderInfo["tradeNo"];                          
        $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                   
        $obj->Send['TotalAmount']       = $orderInfo["total"];                                      
        $obj->Send['TradeDesc']         = "good to drink" ;   //產品描述                     
        $obj->Send['ChoosePayment']     = \ECPay_PaymentMethod::ALL ;                 

        /** 項目 orderItem  */
        $obj->Send['Items'] = $orderInfo["sendItem"] ;
        $obj->CheckOut();

    }

    /** 重導向後 客戶看到結果畫面 */
    public function clientResult( Request $request )
    {

        // return "客戶端";
        $data = $request->all();
        //設定付款結果
        // $result = $this->cart->setPayResult( $data ) ;
        // //訂單更新完成 購物車直接建立新的在重導向到首頁
        // session()->put( "cart" , [] );
        $message =  $data["RtnCode"] == 1 ? "付款成功" : "付款失敗";
        return "<script>alert('$message');setTimeout(()=>{ location.href='/' },3000)</script>";
    }

    /** 綠界回傳資料給伺服器 做後續處理  */
    public function notifyCallBack( Request $req )
    {
        // return "客戶端";
        $data = $request->all();
        //設定付款結果
        $result = $this->cart->setPayResult( $data ) ;
    }

}
