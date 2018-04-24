<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
/*
 * 文章控制器
 */
class PostController extends Controller
{
    //文章列表
    public function list(){
        $posts=Post::orderBy("created_at",'desc')->paginate(10);

        return view('posts.index',compact('posts'));
    }
    //文章详情
    public function info(Post $post){
        return view("posts.show",compact('post'));
    }
    //创建文章页面
    public function create(){
        return view('posts.create');
    }
    //新增文章
    public function add(Request $request){
        $data=$this->validate($request,[
            'title'=>"required|String|max:10",
            'content'=>"required",

        ]);
        $data['user_id']=1;
        Post::create($data);
        return redirect()->route("posts.list");
    }
    //编辑文章页面
    public  function edit(){
        echo '123';
    }
    //更新文章
    public  function update(){
        
    }
    //删除文章
    public function delete(){
        
    }
}
