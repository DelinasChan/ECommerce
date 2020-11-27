<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Library\Crypto ;

use App\Http\Controllers\ECPayController ;
use App\Http\Controllers\MemberController ;
use App\Http\Controllers\CartController ;
use App\Http\Controllers\DashboardController ;

Route::get("/" ,  [ CartController::class , "products" ]);
Route::get("/product/{productId}" ,  [ CartController::class , "readProduct" ]);
Route::post("/shop/{productId}" ,  [ CartController::class , "readProduct" ]);

Route::group( ["prefix" => "dashboard" , "middleware" => "login" ] , function(){
    
    //後台首頁( 顯示 歷史訂單 查看訂單 管理商品 )
    Route::get("/" ,  function(){ return "後台" ; });
    Route::get("/products" , [ DashboardController::class , "products" ]);

    /** 取得單一 或 編輯 產品 */
    Route::group([ "prefix" => "product" ] , function(){
        Route::get( "{productId}"   ,  [ DashboardController::class , "product" ] ) ;
        Route::get( "create"   ,  [ DashboardController::class , "product" ] )    ;
        Route::post( "save/{productId}"   ,  [ DashboardController::class , "saveProduct" ] ) ;
        Route::post( "save"   ,  [ DashboardController::class , "saveProduct" ] ) ; 
    });

});

/** 購物車資料存在 window.localStorage */
Route::group([ "prefix" => "shop" ] , function(){

    /** 變更購物車 新增或修改數量 */
    Route::post(   "modifyCart/{productId}" , [ CartController::class   , "modifyCart" ] );
    Route::delete( "modifyCart/{productId}" , [ CartController::class , "readCart" ]);
    /** 查看購物車頁面 */
    Route::get("cart" , [ CartController::class , "readCart" ])->middleware("login");

});

/** 綠界金流相關路由 */
Route::group(["prefix" => "ecpay"] , function(){
    /** 按下立即購買 表單重導向 */
    Route::get("payNow"     , [ ECPayController::class , "payNow" ] )->middleware("login");;
    /** 客戶端重導向結果頁面 */
    Route::post("clientResult" , [ ECPayController::class , "clientResult" ] );
    /** 金流 callBack 處理網址  */
    Route::post("callBack"   , [ ECPayController::class , "notifyCallBack" ]);
});

/** 登出 */
Route::get("member/logout", function(){
    session()->forget('user');
    return redirect("/");
});

Route::group(["prefix" => "member", "middleware"=>["NotLogin"]] , function( ){

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

    /** 前台購物車 */
    Route::get("/front/products" , [ CartController::class , "products" ] );

});
