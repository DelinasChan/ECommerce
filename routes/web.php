<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Library\Crypto ;

use App\Http\Controllers\ECPayController ;
use App\Http\Controllers\MemberController ;
use App\Http\Controllers\CartController ;

Route::get("encode" , function(Request $request){
    $payload = [ "name" => "Job" , "action" => "register" ];
    return [ "token" => Crypto::JwtEncode( [] , 30 ) ];
});

Route::get("decode" , function(Request $request){
    $token =  $request->query("token") ;
    return Crypto::JwtDecode( $token ) ;
});

/**
 * 購物車資料存在 window.localStorage
*/
Route::get("/shop/cart" , [ ECPayController::class , "test" ] );

Route::get("session/destroy" , function(){
    Session::flush();
});

/** 購物相關路由 */
Route::group(["prefix" => "shop"] , function(){
});

/** 綠界金流相關路由 */
Route::group(["prefix" => "ecpay"] , function(){
    /** 按下立即購買 表單重導向 */
    Route::post("payNow"     , [ ECPayController::class , "payNow" ] );
    /** 客戶端重導向結果頁面 */
    Route::post("resultPage" , [ ECPayController::class , "clientResult" ] );
    /** 金流 callBack 處理網址  */
    Route::post("callBack"   , [ ECPayController::class , "notifyCallBack" ]);
});

Route::group(["prefix" => "member"] , function( ){
    /** 根據memberId 參數 驗證信箱 */
    Route::get("verifyMail/{memberId}" , [ MemberController::class , "verifyMail" ] );
});

/** ajax api Route */
Route::group( ["prefix"=>"api" , 'middleware' => ['api'] ] , function(){

    Route::get("/", function(){ return "ABC" ; });

    /** 前台購物車 api */
    Route::group( ["prefix"=>"cart"] , function() {

        /** 新增商品到購物車 */
        Route::post( "addItem"   , [ CartController::class , "modifyItem" ] );
        Route::get( "addItem"   , [ CartController::class , "modifyItem" ] );


    });

});

/** 測試路由 */
Route::group(["prefix" => "test"] , function( ){

    Route::get("/" , function(){
        return strtoupper( substr( hash("md5" , time() ) , 0 , 10 ) );
    });

    /** 會員註冊 送出信箱 */
    Route::post( "register" , [ MemberController::class , "register" ] );
    Route::get( "/session" , [ CartController::class , "sessionTest" ]);

});
