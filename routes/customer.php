<?php

use Illuminate\Support\Facades\Route;

/**顧客專用路由 */

Route::get('',function(){
    return sortVal();
});