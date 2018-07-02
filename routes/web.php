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
Route::post('getBaseInfos', 'BaseInfosController@getBaseInfos')->name('baseinfos.getBaseInfos');
Route::post('createBaseInfo', 'BaseInfosController@createBaseInfo')->name('baseinfos.createBaseInfo');
Route::post('deleteBaseInfo', 'BaseInfosController@deleteBaseInfo')->name('baseinfos.deleteBaseInfo');
Route::post('getBrands', 'BrandsController@getBrands')->name('brands.getBrands');

Route::post('getBrandConfigs', 'BrandsController@getBrandConfigs')->name('brands.getBrandConfigs');
Route::post('createBrandConfig', 'BrandsController@createBrandConfig')->name('brands.createBrandConfig');
Route::post('deleteBrandConfig', 'BrandsController@deleteBrandConfig')->name('brands.deleteBrandConfig');

Route::post('getVinConfigs', 'VinsController@getVinConfigs')->name('vins.getVinConfigs');
Route::post('createVinConfig', 'VinsController@createVinConfig')->name('vins.createVinConfig');
Route::post('deleteVinConfig', 'VinsController@deleteVinConfig')->name('vins.deleteVinConfig');

Route::post('getNodes', 'PermisesController@getNodes')->name('permises.getNodes');
Route::post('createNode', 'PermisesController@createNode')->name('permises.createNode');
Route::post('deleteNode', 'PermisesController@deleteNode')->name('permises.deleteNode');

Route::post('getRoles', 'PermisesController@getRoles')->name('permises.getRoles');
Route::post('createRole', 'PermisesController@createRole')->name('permises.createRole');
Route::post('deleteRole', 'PermisesController@deleteRole')->name('permises.deleteRole');

Route::post('getUsers', 'UsersController@getUsers')->name('users.getUsers');
Route::post('createUser', 'UsersController@createUser')->name('users.createUser');
Route::post('deleteUser', 'UsersController@deleteUser')->name('users.deleteUser');