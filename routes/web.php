<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Library\Crypto ;

use App\Http\Controllers\ECPayController ;
use App\Http\Controllers\MemberController ;
use App\Http\Controllers\CartController ;
use App\Http\Controllers\DashboardController ;



use Aws\S3\S3Client ;


Route::get("/aws" , function( Request $request ){

    $credentials =  config("aws.credentials")  ;
    $s3 = new S3Client([
        "version" => config("aws.version"),
        'region'  => config("aws.region"),
        'scheme'  => 'http'    
    ]);

    $res = $s3->putObject([
        'Bucket' => config("aws.bucket"),
        'Key'    => 'image/abc.txt',
        'Body'   => '文字內容'
    ]);

    dd( $s3 );

});

Route::post("/upload" , function( Request $request ){
    $s3 = AWS::createClient('s3');
    $iterator = $s3->getIterator('ListObjects', array(
        'Bucket' => "image"
    ));
});

Route::group( ["prefix" => "dashboard"] , function(){

    Route::get("/" ,  function(){
        return "後台" ;
    });

    Route::group([ "prefix" => "product" ] , function(){

        /** 列表產品 */
        Route::get( "/" , [ DashboardController::class , "products" ] ) ;
        Route::get( "edit/{productId}"   ,  [ DashboardController::class , "product" ] ) ;
        Route::get( "create"   ,  [ DashboardController::class , "product" ] )    ;
        Route::post( "save"   ,  [ DashboardController::class , "saveProduct" ] ) ;
        
    });

});

/** 購物車資料存在 window.localStorage */
Route::get("/shop/cart" , [ ECPayController::class , "test" ] );


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

/** 測試路由 */
Route::group(["prefix" => "test"] , function( ){

    Route::get("/" , function(){
        return strtoupper( substr( hash("md5" , time() ) , 0 , 10 ) );
    });

    /** 會員註冊 送出信箱 */
    Route::post( "register" , [ MemberController::class , "register" ] );

});
