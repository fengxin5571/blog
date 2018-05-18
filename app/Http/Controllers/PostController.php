<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
 * 文章控制器
 */
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth",['except'=>['list','info','search']]);
    }

    //文章列表
    public function list(){
        $posts=Post::orderBy("created_at",'desc')->withCount(['comments','zans'])->with('user')->paginate(10);

        return view('posts.index',compact('posts'));
    }
    //文章详情
    public function info(Post $post){
        $post::with("comments");//预加载
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
    public  function edit(Post $post){
        return view('posts.edit',compact('post'));
    }
    //更新文章
    public  function update(Post $post,Request $request){
        $data=$this->validate($request,[
            'title'=>'required|max:10',
            'content'=>'required'
        ]);
        $this->authorize('update',$post);
        $post->update($data);
        return redirect()->route('posts.info',compact('post'));
    }
    //删除文章
    public function delete(Post $post){
        $this->authorize('delete',$post);
        Post::destroy($post->id);
        return redirect()->route('posts.list');
    }
    //图片上传
    public function upload(Request $request){
        $path=$request->file('wangEditorH5File')->store(1);
        return asset('storage/'.$path);
    }
    //增加评论
    public function add_comment(Request $request,Post $post){
        $data=$this->validate($request,[
            'content'=>'required|min:5'
        ]);
        if($post->user_id==Auth::user()->id){
            return redirect()->back()->withErrors("自己的文章不能评论");
        }
        $data['user_id']=Auth::user()->id;
        $post->comments()->create($data);
        return redirect()->route('posts.info',compact('post'));
    }
    //赞
    public function zan(Post $post){
        if($post->user_id==Auth::id()){
            return redirect()->back()->withErrors('不能给自己的文章点赞');
        }
        $data=['user_id'=>Auth::user()->id,'post_id'=>$post->id];
        $post->zan(Auth::user()->id)->firstOrCreate($data);
        return redirect()->back();
    }
    //取消赞
    public function unzan(Post $post){
        $post->zan(Auth::id())->delete();
        return redirect()->back();
    }
    //文章搜索
    public function search(Request $request){
        $this->validate($request,[
            'query'=>'required',
        ]);
        $query=$request->input('query');
        $posts=Post::search($query)->paginate(10);
        return view('posts.search',compact('posts','query'));
    }
}
