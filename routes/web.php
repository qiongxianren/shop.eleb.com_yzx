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

Route::get('/', function () {
    return view('welcome');
});

//分类列表
Route::get('/shop_category/list','ShopCategoryController@list')->name('shop_category.list');

//添加商家
Route::get('/shop/add','ShopController@add')->name('shop.add');
Route::post('/shop/save','ShopController@save')->name('shop.save');

//添加商户
Route::get('/user/add','UserController@add')->name('user.add');
Route::post('/user/save','UserController@save')->name('user.save');
//商户界面
Route::get('/user/index','UserController@index')->name('user.index');

//商户登录
Route::get('login','SessionController@create')->name('login');
Route::post('login','SessionController@store')->name('login');
//商户注销
Route::get('logout','SessionController@destroy')->name('logout');
//商户密码修改
Route::get('/user/editpwd/{user}','UserController@editpwd')->name('user.editpwd');
Route::post('/user/updatepwd/{user}','UserController@updatepwd')->name('user.updatepwd');
