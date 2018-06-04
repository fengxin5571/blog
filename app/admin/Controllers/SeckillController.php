<?php
/**
 * Created by PhpStorm.
 * User: fengxin
 * Date: 2018/6/4
 * Time: 下午3:14
 */
namespace  App\admin\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class  SeckillController extends Controller{
    //秒杀管理
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
}