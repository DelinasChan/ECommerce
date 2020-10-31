<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    return config("mail.sender") ;
});


Route::group(["prefix" => "member"] , function( ){

    /** 根據查詢字串 驗證信箱 */
    Route::get("verifyMail/{memberId}" , function( Request $request , $memberId ){ 
        return "信箱認證 Code: " . $request->query("verifycode") ; ;
    });

});


/** 測試路由 */
Route::group(["prefix" => "test"] , function( ){

    Route::get("/" , function(){
        return config("mail.sender") ;
    });

    /** 會員註冊 送出信箱 */
    Route::post( "register" , "App\Http\Controllers\MemberController@register" );

});
