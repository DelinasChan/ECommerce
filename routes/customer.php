<?php

use Illuminate\Support\Facades\Route;

use App\Constants\OrderConstant;

Route::group(['prefix'=>'api/v1','namespace'=>'User'],function(){

    //訂閱api
    Route::prefix('subscription')->group(function(){
        Route::get('store','SubscriptionController@store')->name('api.subscription.store');
    });

});

/**顧客專用路由 */
Route::get('home',function(){
    return view('home');
});
