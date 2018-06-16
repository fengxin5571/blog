<?php
/**
 * Created by PhpStorm.
 * User: fengxin
 * Date: 2018/6/4
 * Time: 下午3:14
 */
namespace  App\admin\Controllers;

use App\Models\Active;
use App\Models\Good;
use App\Models\Order;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class  SeckillController extends Controller{
    //秒杀管理
    public function index(){
        $actives=Active::all();
        return view('admin.seckill.index',compact('actives'));
    }
    //秒杀设置
    public function setting(Request $request){
        if($request->isMethod('post')){
           $date=explode('-',$request->date);
           if(is_array($date)){
               Cache::forget('seckill');
               Cache::rememberForever('seckill',function ()use ($date){//永远保存秒杀时间
                   return $date;
               });
              return redirect()->route('admin.home');
           }
           return redirect()->back()->withErrors('对不起，时间获取异常');
        }
        return view('admin.seckill.setting');
    }
    //新增秒杀
    public function add(Request $request){
        if($request->isMethod('post')){
           $value=$this->validate($request,[
               'title'=>'required',
               'date'=>'required',
               'goods'=>'required|array',
               'status'=>'required',
               'price_discount'=>'required|numeric|min:0.1'
           ]);
           //dd($value);
           $date['title']=$value['title'];
           $time=explode('-',$value['date']);
           $date['time_begin']=strtotime($time[0]);
           $date['time_end']=strtotime($time[1]);
           $date['status']=$value['status'];
           $date['ip']=$request->getClientIp();
           //dd(Good::where('id',$value['goods'])->update(['price_discount'=>$value['price_discount']]));
           $active=Active::create($date);
           if($active){
               Redis::mset(array(
                   'st_a_'.$active->id=>$active->status,
                   'st_a_'.$active->id."_time_begin"=>$active->time_begin,
                   'st_a_'.$active->id."_time_end"=>$active->time_end,
               ));
               $active->addGoods(Good::find($value['goods']),$value['price_discount']);

               return redirect()->route('admin.seckill.index');
           }

        }
        $goods=Good::all();
        return view('admin.seckill.add',compact('goods'));
    }
    //活动订单
    public function order(){
        $orders=Order::with(['user','active'])->orderBy('created_at','desc')->has('active')->has('user')->paginate(2);
        return view('admin.seckill.order',compact('orders'));
    }
    //问答列表
    public function question(){
        $quesions=Question::with('question_answers')->paginate(10);
        return view('admin.seckill.question',compact('quesions'));
    }
    //新增问答描述
    public function addQuestion(Request $request){
        if($request->isMethod('post')){//是否提交
            $data=$this->validate($request,[
                'question'=>'required|min:3|string'
            ],[
                ':question.required'=>':attribute 不能为空'
            ],[
                'question'=>'问题描述'
                ]);
            Question::create($data);
            return redirect()->route('admin.seckill.question');

        }
        return view('admin.seckill.addQuestion');
    }
    //新增问题项
    public function addAnswer(Request $request){
        if($request->isMethod('post')){
            $this->validate($request,[
                'question'=>'required',
                'answers.*.question_title'=>'required',
                'answers.*.question_answer'=>'required',
            ]);
            $question=Question::find($request->question);
            $answers=$request->answers;
            $question->addAnswers($answers);
            return redirect()->route('admin.seckill.question');
        }
        $questions=Question::all();
        return view('admin.seckill.answer_add',compact('questions'));
    }
}