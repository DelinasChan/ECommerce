<?php

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('login', 'MemberController@login')->name('login');
    Route::post('login', 'MemberController@login')->name('login');
    Route::post('logout', 'MemberController@logout')->name('logout');
    Route::get('register', 'MemberController@register')->name('register');
    Route::post('register', 'MemberController@register')->name('register');
    Route::get('validation', 'MemberController@validation')->name('validation');

    Route::get('social-login/{social_provider}', 'MemberController@social_login')
        ->where('social_provider', '[A-Za-z]+')->name('social.login');
    Route::get('social-callback', 'MemberController@social_login_callback')->name('social.callback');
});
