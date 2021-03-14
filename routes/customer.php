<?php

use Illuminate\Support\Facades\Route;

use App\Constants\OrderConstant;

/**顧客專用路由 */
Route::get('',function(){
    return view('customer.index');
});

Route::get('test',function(){
    return OrderConstant::$READY;
});
