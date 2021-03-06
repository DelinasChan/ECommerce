<?php

Route::group(['prefix' => 'dashboard', 'middleware' => ['web', 'Login']], function () {
    Route::get('/{path?}', 'DashboardCOntroller@index')
        ->where('path', '^((?!api).)*$')->name('dashboard.index');

    //Dashboard Api...
    Route::prefix('/api/v1')->name('dashboard.api.')->group(function () {

        Route::prefix('media')->name('media.')->group(function () {
            Route::get('index', 'MediaController@index')->name('index');
            Route::post('create', 'MediaController@create')->name('create');
            Route::delete('destroy', 'MediaController@destroy')->name('destroy');
        });

        Route::prefix('product')->group(function () {
            //取得商品
            Route::get('/{product}', 'ProductController@show')
                ->where('id', '[0-9]+')->name('product.show');
            //刪除商品
            Route::delete('/{product}', 'ProductController@destroy')
                ->where('product', '[0-9]+')->name('product.destroy');
            //建立或儲存商品
            Route::post('store/{product?}', 'ProductController@store')
                ->where('product', '[0-9]+')->name('product.store');
        });

    });

});
