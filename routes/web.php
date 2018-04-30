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

//用户模块
Route::prefix("users")->group(function(){
    //用户注册
    Route::get("register","UserController@index")->name("users.register");
    Route::post('register',"UserController@register")->name('users.register');
    //用户登录
    Route::match(['get','post'],"login","UserController@login")->name("login");
    //用户登出
    Route::get('/logout',"UserController@logout")->name("users.logout");
    //用户中心
    Route::get('center/{user}',"UserController@center")->name("users.home");
});
/*文章列表页*/
Route::get("/posts","PostController@list")->name('posts.list');
/* 文章详情页*/
Route::get("/posts/{post}","PostController@info")->name('posts.info');
/*创建文章*/
Route::get('/post/create','PostController@create')->name('posts.create');
/*添加文章*/
Route::post("/posts","PostController@add")->name('posts.add');
//编辑文章
Route::get('/posts/{post}/edit',"PostController@edit")->name("posts.edit");
Route::put("/posts/{post}","PostController@update")->name("posts.edit");
//删除文章
Route::get("/posts/{post}/del","PostController@delete")->name('posts.delete');
//文章图片上上传
Route::post('/posts/image/upload','PostController@upload');
