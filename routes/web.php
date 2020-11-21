<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Library\Crypto ;

use App\Http\Controllers\ECPayController ;
use App\Http\Controllers\MemberController ;
use App\Http\Controllers\CartController ;
use App\Http\Controllers\DashboardController ;


Route::get("/" , function(){

    $url = "http://eshopbulk.s3.ap-northeast-1.amazonaws.com/media/member_1/1605964320-close-up-of-squirrel-on-field-314865.jpg" ;
    $arr =  explode(  "/" , $url  ) ;
    dd( $arr[count(  explode(  "/" , $url  )) - 1  ]);
});

Route::group( ["prefix" => "dashboard"] , function(){

    Route::get("/" ,  function(){ return "後台" ; });

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
Route::group( [ "prefix" => "api" ] , function(){

    Route::post("s3/upload" , function( Request $request ){
         
        if( $request->hasFile('image') )
        {
            $file =$request->file('image');
            try{
                $result = AWSClient::uploadS3( $file , "media/member_1/" )->saveToDB() ;
                return response()->json([  "status" => true , "result" => $result ]);    
            }catch( S3Exception $e ){
                return response()->json([  "status" => false , "message" => $e ]);
            }
        }else{
            return response()->json([  "status" => false , "message" => "file is empty" ]);
        }
  
    });

});


/** 測試路由 */
Route::group(["prefix" => "test"] , function( ){

    Route::get("/" , function(){
        return strtoupper( substr( hash("md5" , time() ) , 0 , 10 ) );
    });

    /** 會員註冊 送出信箱 */
    Route::post( "register" , [ MemberController::class , "register" ] );

});
