<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('lang/{lang}', 'HomeController@select')->name('select');
Route::get('dark/{code}', 'HomeController@dark')->name('dark');
Route::get('/migrate', function(){
    \Artisan::call('migrate');
});
Route::get('/', 'HomeController@index')->name('/');


