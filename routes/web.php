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
/*文章列表页*/
Route::get("/posts","PostController@list")->name('posts.list');
/* 文章详情页*/
Route::get("/posts/{post}","PostController@info")->name('posts.info');
/*创建文章*/
Route::get("/posts/create","PostController@create")->name("posts.create");
/*添加文章*/
Route::post("/posts","PostController@add")->name('posts.create');
//编辑文章
Route::get('/posts/{post}/edit',"PostController@edit")->name("posts.edit");
Route::put("/posts/{post}","PostController@update")->name("posts.edit");
//删除文章
Route::delete("/posts/{post}/del","PostController@delete")->name('posts.delete');