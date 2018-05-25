<?php
/**
 * Created by PhpStorm.
 * User: fengxin
 * Date: 2018/5/9
 * Time: 下午4:30
 */
namespace App\admin\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller{
    public function index(){

        if(Gate::forUser(Auth::guard('admin')->user())->allows('post')) {
            $posts = Post::withoutGlobalScope('scuess_status')->where('status', 0)->orderBy('created_at', 'esc')->paginate(5);
            $flag = 0;
            return view('admin.posts.index', compact('posts', 'flag'));
        }
    }
    //文章审核
    public function status(Request $request,$post_id){
        if(Gate::forUser(Auth::guard('admin')->user())->allows('post')) {
            $post = Post::withoutGlobalScope("scuess_status")->find($post_id);
            $response = array();
            $this->validate($request, [
                'status' => 'required'
            ]);

            if ($post->update(['status' => $request->status])) {
                $response = array('error' => 0, 'message' => '操作成功');
            } else {
                $response = array('error' => 1, 'message' => '操作失败');
            }
            return response()->json($response);
        }
    }
    //通过文章
    public  function scuess_status(){
        if(Gate::forUser(Auth::guard('admin')->user())->allows('post')) {
            $posts = Post::paginate(5);
            $flag = 1;
            return view('admin.posts.index', compact('posts', 'flag'));
        }
    }
    //未通过文章
    public function unscuess_status(){

        $posts = Post::withoutGlobalScope('scuess_status')->where('status', '2')->paginate(5);
        $flag = 3;
        return view('admin.posts.index', compact('posts', 'flag'));

    }
    //删除文章
    public function delete($post_id){

        $post = Post::withoutGlobalScope('scuess_status')->find($post_id);
        if ($post->delete()) {
            $response = array('error' => 0, 'message' => '操作成功');
        } else {
            $response = array('error' => 1, 'message' => '操作失败');
        }
        return response()->json($response);

    }
    public function delList(){

        $posts = Post::withoutGlobalScope('scuess_status')->onlyTrashed()->get();
        return view('admin.posts.del', compact('posts'));

    }
    public function restore($post_id){

        $post = Post::withoutGlobalScope('scuess_status')->onlyTrashed()->where('id', $post_id);
        $post->restore();
        return response()->json(['error' => 0, 'message' => '操作成功']);

    }
}