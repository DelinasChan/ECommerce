<?php

use Illuminate\Support\Facades\Route;

use App\Constants\LoginConstants;

/**顧客專用路由 */
Route::get('', function () {
    dd(LoginConstants::LOGIN_FACEBOOK);
    return '消費者前台';
});
