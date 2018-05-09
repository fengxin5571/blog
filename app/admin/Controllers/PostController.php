<?php
/**
 * Created by PhpStorm.
 * User: fengxin
 * Date: 2018/5/9
 * Time: 下午4:30
 */
namespace App\admin\Controllers;
use App\Models\Post;

class PostController extends Controller{
    public function index(){
        $posts=Post::withoutGlobalScope('scuess_status')->where('status',0)->orderBy('created_at','decs')->paginate(10);
        return view('admin.posts.index',compact('posts'));
    }
}