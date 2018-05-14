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
    Route::group(['middleware'=>'admin_auth'],function(){
        //首页
        Route::get('/home','HomeController@home')->name('admin.home');
//        Route::group(['middleware'=>"can:system"],function (){
            //管理人员模块
            Route::get('/users','UserController@index')->name('admin.users');
            //用户角色管理
            Route::match(['get','post'],'/users/{adminuser}/role','UserController@role')->name('admin.users.role');
            //增加用户
            Route::get('/users/add','UserController@add')->name('admin.users.add');
            Route::post('/users/add','UserController@add')->name('admin.users.add');
            //角色列表
            Route::get('/roles','RoleController@list')->name('admin.roles');
            //创建角色
            Route::match(['post','get'],'/roles/add','RoleController@add')->name('admin.roles.add');
            //角色权限
            Route::match(['get','post'],'/roles/{adminrole}/permission','RoleController@rolePermission')->name('admin.role.permission');
            //权限列表
            Route::get('/permissions','PermissionController@list')->name('admin.permisssion');
            //创建权限
            Route::match(['post','get'],'/permission/add','PermissionController@add')->name('admin.permission.add');
//        });
//        Route::group(['middleware'=>'can:post'],function (){
            //文章管理
            Route::get('/posts','PostController@index')->name('admin.posts');
            //文章审核
            Route::post('/posts/{post_id}/status','PostController@status')->name('admin.posts.status');
            //已通过文章
            Route::get('/posts/status/1','PostController@scuess_status')->name('admin.posts.status.1');
            //未通过文章
            Route::get('/posts/status/2','PostController@unscuess_status')->name('admin.posts.status.2');
            //删除文章
            Route::post('/posts/{post_id}/del','PostController@delete')->name('admin.posts.del');
            //已删除文章
            Route::get('/posts/del','PostController@delList')->name('admin.posts.del.list');
            //恢复文章
            Route::post('/posts/{post_id}/restore','PostController@restore')->name('admin.post.restore');
//        });


    });


});
