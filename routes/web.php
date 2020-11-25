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

    return time() ;
});

Route::group( ["prefix" => "dashboard"] , function(){

    Route::get("/" ,  function(){ return "後台" ; });
    Route::get("/products" , [ DashboardController::class , "products" ]);

    /** 取得單一 或 編輯 產品 */
    Route::group([ "prefix" => "product" ] , function(){

        /** 列表產品 */
        Route::get( "{productId}"   ,  [ DashboardController::class , "product" ] ) ;
        Route::get( "create"   ,  [ DashboardController::class , "product" ] )    ;
        Route::post( "save/{productId}"   ,  [ DashboardController::class , "saveProduct" ] ) ;
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

    /** 會員註冊 */
    Route::get(  "register" , function(){
        return view("dashboard.register");
    });
    /** 會員登入 */
    Route::get(  "login" , function(){
        return view("dashboard.login");
    });

    /** 第三方登入驗證 #目前只有臉書 */
    Route::group( ["prefix" => "auth"] , function(){
        Route::get("facebook" , [ MemberController::class , "fbLogin" ] );
        Route::get( "fb-callback" , [ MemberController::class , "fbCallBack" ]);
    });

    Route::post( "register" , [ MemberController::class , "register"] );
    Route::post( "login" , [ MemberController::class , "login"] );

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

    Route::get("/media" , [ DashboardController::class ,  "getMedia" ] );
    Route::post("/media/update" , [ DashboardController::class ,  "updateMedia" ] );

    Route::post("/test" , function( Request $request ){
        $result = [];
        foreach( $request->get("image") as $json )
        {
           array_push( $result , json_decode( $json ) );
        };
        
        return response()->json( $result );
        
    });

});
