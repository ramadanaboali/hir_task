<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['api','lang'],'namespace' => 'Api'], function () {




    Route::group(['namespace' => 'Tag'], function () {
        // tag////////
        Route::group([ 'prefix' => 'tags'], function () {
        // index
        Route::get('/', 'TagController@index');
        // create
        Route::post('/', 'TagController@store');
        // get
        Route::get('{tag}', 'TagController@get');
        // update
        Route::put('{tag}', 'TagController@update');
        // delete
        Route::delete('bulkDelete', 'TagController@bulkDelete');
        Route::post('bulkRestore', 'TagController@bulkRestore');
        });
    });


});








