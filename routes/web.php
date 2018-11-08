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
    return view('session.create');
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
Route::post('/user/updatepwd','UserController@updatepwd')->name('user.updatepwd');

//添加菜品分类
Route::get('/menu_category/add','MenuCategoryController@add')->name('menu_category.add');
Route::post('/menu_category/save','MenuCategoryController@save')->name('menu_category.save');
//菜品分类列表
Route::get('/menu_category/list','MenuCategoryController@list')->name('menu_category.list');
//修改菜品分类
Route::get('/menu_category/edit/{cate}','MenuCategoryController@edit')->name('menu_category.edit');
Route::post('/menu_category/update/{cate}','MenuCategoryController@update')->name('menu_category.update');
//删除菜品分类
Route::get('/menu_category/delete/{cate}','MenuCategoryController@delete')->name('menu_category.delete');

//添加菜品
Route::get('/menu/add','MenuController@add')->name('menu.add');
Route::post('/menu/save','MenuController@save')->name('menu.save');
//菜品列表
Route::get('/menu/list','MenuController@list')->name('menu.list');

//活动列表
Route::get('/activity/list','ActivityController@list')->name('activity.list');
//查看活动
Route::get('/activity/show/{row}','ActivityController@show')->name('activity.show');

//订单管理
Route::get('/order/list','OrderController@list')->name('order.list');
//订单详情
Route::get('/order/show/{order}','OrderController@show')->name('order.show');
//取消订单
Route::get('/order/delete/{order}','OrderController@delete')->name('order.delete');
//订单发货
Route::get('/order/save/{order}','OrderController@save')->name('order.save');

//订单统计一周
Route::get('/order/week','TongjiController@order_week');
//订单统计三月
Route::get('/order/month','TongjiController@order_month');

//菜品销量统计
Route::get('/menu/week','TongjiController@menu_week');
//菜品统计三月
Route::get('/menu/month','TongjiController@menu_month');