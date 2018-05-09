<?php
/**
 * Created by PhpStorm.
 * User: fengxin
 * Date: 2018/5/8
 * Time: 上午10:44
 */

Route::prefix('admin')->group(function (){
    //登陆
    Route::get('/login','LoginController@login')->name('admin.login');
    Route::post('/login','LoginController@login')->name('admin.login');
    //登出
    Route::get('/logout','LoginController@logout')->name('admin.logout');
    Route::group(['middleware'=>'auth:admin'],function(){
        //首页
        Route::get('/home','HomeController@home')->name('admin.home');
        //管理人员模块
        Route::get('/users','UserController@index')->name('admin.users');
        //增加用户
        Route::get('/users/add','UserController@add')->name('admin.users.add');
        Route::post('/users/add','UserController@add')->name('admin.users.add');
        //文章管理
        Route::get('/posts','PostController@index')->name('admin.pots');

    });


});
