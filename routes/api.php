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



    Route::group(['namespace' => 'Advertiser'], function () {
        // tag////////
        Route::group([ 'prefix' => 'advertisers'], function () {
            // index
            Route::get('/', 'AdvertiserController@index');
            // create
            Route::post('/', 'AdvertiserController@store');
            // get
            Route::get('{advertiser}', 'AdvertiserController@get');
            // update
            Route::put('{advertiser}', 'AdvertiserController@update');
            // delete
            Route::delete('bulkDelete', 'AdvertiserController@bulkDelete');
            Route::post('bulkRestore', 'AdvertiserController@bulkRestore');
        });
    });


    Route::group(['namespace' => 'Category'], function () {
        // tag////////
        Route::group([ 'prefix' => 'categories'], function () {
            // index
            Route::get('/', 'CategoryController@index');
            // create
            Route::post('/', 'CategoryController@store');
            // get
            Route::get('{Category}', 'CategoryController@get');
            // update
            Route::put('{Category}', 'CategoryController@update');
            // delete
            Route::delete('bulkDelete', 'CategoryController@bulkDelete');
            Route::post('bulkRestore', 'CategoryController@bulkRestore');
        });
    });


});








