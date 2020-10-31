<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Ahc\Jwt\JWT;
use Carbon\Carbon ;

use App\Library\Crypto ;

use App\Http\Controllers\MemberController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Crypto::hash( "123456"  );
});

Route::get("encode" , function(Request $request){
    $payload = [ "name" => "Job" , "action" => "register" ];
    return [ "token" => Crypto::JwtEncode( [] , 30 ) ];
});

Route::get("decode" , function(Request $request){
    $token =  $request->query("token") ;
    return Crypto::JwtDecode( $token ) ;
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
