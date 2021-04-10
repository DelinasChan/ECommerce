<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/{path?}', function () {
        return view('dashboard.index');
    })->where('path', '^((?!api).)*$');;

    //Dashboard Api...
    Route::prefix('/api/v1')->name('dashboard.api.')->group(function () {

        Route::prefix('product')->group(function () {
            //取得商品
            Route::get('/{id}', 'ProductController@show')
                ->where('id', '[0-9]+')->name('product.show');
            //建立商品
            Route::post('create', 'ProductController@create')->name('product.create');
        });

    });

});
