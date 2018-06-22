<?php

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
Route::get('/', 'IndexController@index')->name('index');

Route::post('login', 'LoginController@login');
Route::post('getMerchants', 'MerchantsController@getMerchants')->name('merchants.getMerchants');
Route::post('createMerchants', 'MerchantsController@createMerchants')->name('merchants.createMerchants');
Route::post('deleteMerchants', 'MerchantsController@deleteMerchants')->name('merchants.deleteMerchants');
Route::post('delayMerchants', 'MerchantsController@delayMerchants')->name('merchants.delayMerchants');
Route::post('getBaseInfo', 'BaseInfosController@getBaseInfo')->name('baseinfos.getBaseInfo');