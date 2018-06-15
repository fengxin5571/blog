<?php

namespace App\Http\Controllers;

use App\Models\Active;
use App\Models\Good;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use PHPUnit\Framework\Exception;

class SeckillController extends Controller
{
    //秒杀页面
    public function index(){
        $goods=Good::with('active')->get();
        foreach ($goods as $good){
            Redis::hset('info_g_'.$good->id,'num_left',$good->num_total);
        }
        return view('seckill.index',compact('goods'));
    }
    //秒杀
    public function seckillBuy(Request $request){
        if($request->isMethod('post')){
            $this->validate($request,[
                'goods'=>'required|array',
                'active_id'=>'required|numeric',
                'st_data'=>'required'
            ]);
            if(!Auth::check()){//判断是否登录
                return response()->json(['error'=>1,'text'=>'未登录']);
            }
            $active_id=$request->active_id;
            $st_data=$request->st_data;
            //验证接口传来的数据是否匹配
            if(!$st_data['time']<time()&&!$st_data>time()-300&&$st_data['ip']!=$request->getClientIp()){
                return response()->json(['error'=>1,'text'=>'购买ip或者已超时']);
            }

            if(Auth::user()->activeGood($active_id)){//判断用户是否已经购买过了
                return response()->json(['error'=>1,'text'=>'请不要重复提交订单']);
            }
            // $active=Active::find($active_id);
            if(!$active_id||!$this->checkTime($active_id)){//验证活动信息
                return response()->json(['error'=>1,'text'=>'活动还没有开始']);
            }
            $num_total=$price_total=$price_discount=0;

            DB::beginTransaction();//开启事务，更新库存，创建订单
            try{
                foreach ($request->goods as $i=>$good){//验证商品信息
                    //$good_info=Good::find($good['id']);
                    $good_data=Redis::hMGet('info_g_'.$good['id'],array('good_info','num_left'));
                    $good_info=json_decode($good_data[0]);
                    if(!$good_info){
                        return response()->json(['error'=>1,'text'=>'商品信息异常']);
                    }
                    $num=$good['num'];
                    if($good_info->num_total<$num){//验证商品库存
                        return response()->json(['error'=>1,'text'=>'商品库存不足']);
                    }
                    $num_left=$this->changeLeftNumCached($good_info->id,0-$num);
                    if($num_left>=0){
                        if(!Good::find($good_info->id)->updateNum(0-$num)){
                            throw  new Exception('库存更新错误');
                        }
                        $order_good_info[]=array(
                            'good'=>$good_info,
                            'count'=>$num
                        );
                        $num_total+=$num;
                        $good_id=$good_info->id;
                        $price_total+=$good_info->price_normal*$num;
                        $price_discount+=$good_info->price_discount*$num;
                    }else{
                        Redis::set('st_a_'.$active_id,0);
                        return response()->json(['error'=>1,'text'=>'商品库存不足']);
                    }
                }
                $data['active_id']=$active_id;
                $data['goods_id']=$good_id;
                $data['num_total']=$num_total;
                $data['price_total']=$price_total;
                $data['price_discount']=$price_discount;
                $data['goods_info']=json_encode($order_good_info);
                $data['time_confirm']=time();
                $data['uid']=Auth::id();
                $data['ip']=$request->getClientIp();
                $data['status']=1;
                if(!Order::create($data)){
                    throw  new Exception('订单插入失败');
                }
            }catch (Exception $e){
                DB::rollBack();
            }
            DB::commit();
            Redis::set('u_order_'.Auth::id().'_s_'.$active_id,1);
            return response()->json(['error'=>0,'text'=>'成功']);
        }
    }
    //验证活动状态
    public function checkSeckill(Request $request){
       if($request->isMethod("post")){
            $active_id=$request->aid;
            $good_id=$request->gid;
            $data=Redis::mget(array(
                'st_a_'.$active_id,
                'st_g_'.$good_id
            ));
            if($data[0]&&$data[1]){//验证通过
                $info=array(
                    'time'=>time(),
                    'ip'=>$request->getClientIp()
                );
                return response()->json(['error'=>0,'text'=>'通过','data'=>$info]);
            }
            return response()->json(['error'=>1,'text'=>'活动参数验证异常']);

       }
       return response()->json(['error'=>1,'text'=>'非法请求']);
    }
    //验证时间
    private function checkTime($active_id){
        $data=Redis::mget(array(
            'st_a_'.$active_id."_time_begin",
            'st_a_'.$active_id."_time_end",
        ));
        if($data&&$data[0]&&$data[1]){
            if(Carbon::now()->between(Carbon::createFromTimestamp($data[0]),Carbon::createFromTimestamp($data[1]))){
               return true;
            }

        }
        Redis::set('st_a_'.$active_id,0);
        return false;
    }
    //减少库存
    private function changeLeftNumCached($good_id,$num){
       return  Redis::hincrby('info_g_'.$good_id,'num_left',$num);
    }
}
