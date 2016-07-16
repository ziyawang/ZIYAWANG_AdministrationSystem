<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'as' => 'profile', 'uses' => 'Admin\LoginController@index'
]);
Route::get('login/index', [
    'as' => 'profile', 'uses' => 'Admin\LoginController@index'
]);
//Route::get('system/index', [
//    'as' => 'profile', 'uses' => 'Admin\SystemController@index'
//]);
Route::post('/admin/login', [
    'as' => 'profile', 'uses' => 'Admin\LoginController@login'
]);

//系统管理中人员管理路由
Route::get('system/index', 'Admin\SystemController@index');
Route::get('system/add', 'Admin\SystemController@add');
Route::post('systems/system/add', 'Admin\SystemController@add');
Route::get('system/update/{id}', 'Admin\SystemController@update');
Route::post('systems/system/update', 'Admin\SystemController@update');
Route::get('system/delete/{id}', 'Admin\SystemController@delete');


//系统管理中权限路由
Route::get('auth/index', 'Admin\AuthController@index');
Route::get('auth/add', 'Admin\AuthController@add');
Route::get('auth/update', 'Admin\AuthController@update');

//系统管理中角色路由
Route::get('role/index', 'Admin\AuthController@index');
Route::get('role/add', 'Admin\AuthController@add');
Route::get('role/update', 'Admin\AuthController@update');

//会员管理中的发布方管理路由
Route::get('publish/index', 'Admin\PublishController@index');
Route::get('publish/detail/{id}', 'Admin\PublishController@detail');

//会员管理中的服务方管理路由
Route::get('service/index', 'Admin\ServiceController@index');
Route::get('service/detail/{id}', 'Admin\ServiceController@detail');

//会员管理中的审核发布信息路由
Route::get('check/index', 'Admin\CheckController@index');
Route::get('check/add', 'Admin\CheckController@add');
Route::get('check/detail/{id}', 'Admin\CheckController@detail');

//合作管理中的订单管理路由
Route::get('order/index', 'Admin\OrderController@index');
Route::get('order/detail/{id}', 'Admin\OrderController@detail');

//合作管理中的退单管理路由
Route::get('refuse/index', 'Admin\RefuseController@index');
Route::get('refuse/detail', 'Admin\RefuseController@detail');

//新闻视频中的新闻管理路由
Route::get('news/index', 'Admin\NewsController@index');
Route::get('news/add', 'Admin\NewsController@add');
Route::post('news/add', 'Admin\NewsController@save');
Route::get('news/update', 'Admin\NewsController@update');
Route::get('news/delete', 'Admin\NewsController@delete');
Route::any('news/upload', 'Admin\NewsController@upload');

//新闻视频中的视频管理路由
Route::get('video/index', 'Admin\VideoController@index');
Route::get('video/add', 'Admin\VideoController@add');
Route::get('video/update', 'Admin\VideoController@update');
Route::get('video/delete', 'Admin\VideoController@delete');

//推送管理中的推送信息路由
Route::get('push/index', 'Admin\PushController@index');
Route::get('push/detail', 'Admin\PushController@detail');



