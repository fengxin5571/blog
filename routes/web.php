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
    Route::get("/register","UserController@index")->name("users.register");
    Route::post('/register',"UserController@register")->name('users.register');
    //用户登录
    Route::match(['get','post'],"login","UserController@login")->name("login");
    //用户登出
    Route::get('/logout',"UserController@logout")->name("users.logout");
    //用户中心
    Route::get('/center/{user}',"UserController@center")->name("users.home");
    //关注
    Route::post('/user/{user}/fan','UserController@fan')->name('users.fan');
    //取消关注
    Route::post('/user/{user}/unfan','UserController@unfan')->name('users.unfan');
    //用户设置
    Route::get('/user/seting/{user}','UserController@userseting')->name('users.seting');
    Route::post('/user/seting/{user}','UserController@userseting')->name('users.seting');
});
/*文章列表页*/
Route::get("/posts","PostController@list")->name('posts.list');
//文章搜索
Route::get('/posts/search','PostController@search')->name("posts.search");
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
//增加评论
Route::post('/posts/comment/{post}','PostController@add_comment')->name('posts.comment');
//点赞
Route::get("/posts/zan/{post}","PostController@zan")->name('posts.zan');
//取消赞
Route::get('/posts/unzan/{post}','PostController@unzan')->name('posts.unzan');
//文章搜索
Route::get('posts/search','PostController@search')->name("posts.search");
//专题
Route::prefix('topic')->group(function (){
    //专题首页
    Route::get('/{topic}','TopicController@index')->name('topic.info');
    //投稿
    Route::post('/submit/{topic}','TopicController@submit')->name('topic.submit');
});
//通知
Route::get('/notices','NoticeController@index')->name('notices');

//api
Route::prefix('api')->group(function (){
    Route::get('/users',function (){
        return new \App\Http\Resources\Users(\App\Models\User::paginate(2));
    });
});
//秒杀
Route::group(['middleware'=>['auth','seckill']],function(){
    Route::get('/seckill','SeckillController@index')->name('seckill');
    Route::post('/seckill/buy','SeckillController@seckillBuy')->name('seckill.buy');
});



