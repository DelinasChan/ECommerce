<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/{path?}', function () {
        return view('dashboard.index');
    })->where('path', '^((?!api).)*$');;
});
