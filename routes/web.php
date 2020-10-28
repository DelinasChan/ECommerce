<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Library\Crypto ;

use App\Http\Controllers\ECPayController ;
use App\Http\Controllers\MemberController ;


Route::get("encode" , function(Request $request){
    $payload = [ "name" => "Job" , "action" => "register" ];
    return [ "token" => Crypto::JwtEncode( [] , 30 ) ];
});

Route::get("decode" , function(Request $request){
    $token =  $request->query("token") ;
    return Crypto::JwtDecode( $token ) ;
});

/** 綠界相關路由 */
Route::get("/pay" , [ ECPayController::class , "test" ] );
Route::group(["prefix" => "ecpay"] , function( ){

    /** 客戶端重導向結果頁面 */
    Route::post("resultPage" , [ ECPayController::class , "clientResult" ] );

});

Route::group(["prefix" => "member"] , function( ){

    /** 根據查詢字串 驗證信箱 */
    Route::get("verifyMail/{memberId}" , [ MemberController::class , "verifyMail" ] );

});


/** 測試路由 */
Route::group(["prefix" => "test"] , function( ){

    Route::get("/" , function(){
        return config("mail.sender") ;
    });

    /** 會員註冊 送出信箱 */
    Route::post( "register" , "App\Http\Controllers\MemberController@register" );

});
