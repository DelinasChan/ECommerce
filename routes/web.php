<?php

Route::prefix('auth')->name('auth.')->group(function () {
    //會員登入
    Route::get('login', 'MemberController@login')->name('login.view');
    Route::post('login', 'MemberController@loginHandler')->name('login.active');

    //會員註冊
    Route::get('register', 'MemberController@register')->name('register.view');
    Route::post('register', 'MemberController@registerHandler')->name('register.active');

    Route::post('logout', 'MemberController@logout')->name('logout');
    Route::get('validation/{member}', 'MemberController@validation')
        ->name('validation')->where('member', '^[0-9]+$');

    //第三方登入
    Route::get('social-login/{social_provider}', 'MemberController@social_login')
        ->where('social_provider', '[A-Za-z]+')->name('social.login');
    Route::get('social-callback', 'MemberController@social_login_callback')->name('social.callback');
});
