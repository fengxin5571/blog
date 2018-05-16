<?php
/**
 * Created by PhpStorm.
 * User: fengxin
 * Date: 2018/5/16
 * Time: 下午1:30
 */
namespace App\admin\Controllers;
use App\Jobs\SendMessage;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller{
    //通知管理
    public function index(){
        $notices=Notice::all();
        return view('admin.notice.index',compact('notices'));
    }
    //增加通知
    public function add(Request $request){
        if($request->isMethod('post')){
            $data=$this->validate($request,[
                'title'=>'required|min:3',
                'content'=>'required|min:3'
            ]);
           $notice= Notice::create($data);
//            SendMessage::dispatch()
            $this->dispatch(new SendMessage($notice));
            return redirect()->route('admin.notices');
        }
        return view('admin.notice.add');
    }
}