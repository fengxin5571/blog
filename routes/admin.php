<?php
/**
 * Created by PhpStorm.
 * User: fengxin
 * Date: 2018/5/8
 * Time: 上午10:44
 */
Route::redirect('/admin/','/admin/home',301);
Route::prefix('admin')->group(function (){
    //登陆
    Route::get('/login','LoginController@login')->name('admin.login');
    Route::post('/login','LoginController@login')->name('admin.login');
    //登出
    Route::get('/logout','LoginController@logout')->name('admin.logout');
    Route::group(['middleware'=>'auth:admin'],function(){
        //首页
        Route::get('/home','HomeController@home')->name('admin.home');
        Route::group(['middleware'=>"can:system"],function (){
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
        });
        Route::group(['middleware'=>'can:post'],function (){
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
        });
        Route::group(['middleware'=>'can:topic'],function (){
            //专题管理
            Route::get('/topics','TopicController@index')->name('admin.topics.index');
            //增加专题
            Route::match(['post','get'],'/topics/add','TopicController@add')->name('admin.topics.add');
            //删除专题
            Route::delete('/topics/{topic}/del','TopicController@delete')->name('admin.topics.del');
            //通知管理
            Route::get('/notices','NoticeController@index')->name('admin.notices');
            //增加通知
            Route::match(['get','post'],'/notices/add','NoticeController@add')->name('admin.notices.add');
        });
        Route::group(['middleware'=>'can:goods'],function(){
            //商品管理
            Route::get('/goods','GoodsController@index')->name('admin.goods');
            //增加商品
            Route::match(['get','post'],'/goods/add','GoodsController@addGood')->name('admin.goods.add');
        });
        Route::group(['middleware'=>'can:seckill'],function(){
            //秒杀管理
            Route::get('/seckill','SeckillController@index')->name('admin.seckill.index');
            Route::get('/seckill/setting','SeckillController@setting')->name('admin.seckill.setting');
            Route::post('/seckill/setting','SeckillController@setting')->name('admin.seckill.setting');
            //新增秒杀
            Route::match(['get','post'],'/seckill/add','SeckillController@add')->name('admin.seckill.add');
            Route::get('/seckill/order','SeckillController@order')->name('admin.seckill.order');
            //秒杀问答
            Route::get('/seckill/question','SeckillController@question')->name('admin.seckill.question');
            //新增问题描述
            Route::match(['get','post'],'/seckill/question/add','SeckillController@addQuestion')->name('admin.seckill.question.add');
        });

    });


});
