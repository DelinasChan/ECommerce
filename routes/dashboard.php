<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'dashboard'],function(){
    Route::get('',function(){
        return view('dashboard.index');
    });
});
