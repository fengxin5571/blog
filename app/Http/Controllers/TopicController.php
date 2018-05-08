<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>'index']);
    }

    //专题控制器
    public function index(Topic $topic){
        $topic=$topic::withCount('topicPosts')->find($topic->id);
        $user_posts=Post::authorby(Auth::id())->topicnot($topic->id)->orderBy('created_at','desc')->get();
        $topic_posts=$topic->topicPosts()->orderBy('created_at','desc')->paginate(10);
        return view('topic.index',compact('topic','user_posts','topic_posts'));
    }
    //投稿
    public function submit(Request $request,Topic $topic){
        $this->validate($request,[
            'post_ids'=>'required'
        ],[
            'post_ids.required'=>'至少选择一篇文章',
        ]);
        $topic->topicPosts()->sync($request->post_ids,false);
        return redirect()->route('topic.info',compact('topic'));

    }
}
