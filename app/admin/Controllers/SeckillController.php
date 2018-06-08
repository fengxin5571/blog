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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class  SeckillController extends Controller{
    //秒杀管理
    public function index(){
        return view('admin.seckill.index');
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
               $active->addGoods(Good::find($value['goods']),$value['price_discount']);
               return redirect()->route('admin.seckill.index');
           }

        }
        $goods=Good::all();
        return view('admin.seckill.add',compact('goods'));
    }
}