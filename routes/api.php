<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['api','lang'],'namespace' => 'Api'], function () {




    Route::group(['namespace' => 'Assigned'], function () {
        // Assigned////////
        Route::group([ 'prefix' => 'assigned'], function () {
        // index
        Route::get('/', 'AssignedController@index');
        // create
        Route::post('/', 'AssignedController@store');
        // get
        Route::get('{assigned}', 'AssignedController@get');
        // update
        Route::put('{assigned}', 'AssignedController@update');
        // delete
        Route::delete('bulkDelete', 'AssignedController@bulkDelete');
        Route::post('bulkRestore', 'AssignedController@bulkRestore');
        });
    });


});








