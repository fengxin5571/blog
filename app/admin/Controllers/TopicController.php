<?php
/**
 * Created by PhpStorm.
 * User: fengxin
 * Date: 2018/5/15
 * Time: 上午9:43
 */
namespace App\admin\Controllers;
use App\Models\Topic;
use Illuminate\Http\Request;

class  TopicController extends Controller{
    //专题管理
    public function index(){
        $topics=Topic::orderBy('created_at','asc')->get();
        return view('admin.topic.index',compact('topics'));
    }
    //增加专题
    public function add(Request $request){
        if($request->isMethod('post')){
            $data=$this->validate($request,[
                'name'=>'required|min:2',
            ]);
            Topic::create($data);
            return redirect()->route('admin.topics.index');
        }
        return view('admin.topic.add');
    }
    //删除专题
    public function delete(Topic $topic){
        if($topic->delete()){
            $message=['error'=>0,'message'=>'删除成功'];
        }else {
            $message = ['error' => 1, 'message' => '删除失败'];
        }
        return response()->json($message);
    }
}