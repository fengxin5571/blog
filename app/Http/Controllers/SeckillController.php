<?php

namespace App\Http\Controllers;

use App\Models\Active;
use App\Models\Good;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Exception;

class SeckillController extends Controller
{
    //秒杀页面
    public function index(){
        $goods=Good::with('active')->get();
        return view('seckill.index',compact('goods'));
    }
    public function seckillBuy(Request $request){
        if($request->isMethod('post')){
            $this->validate($request,[
                'goods'=>'required|array',
                'active_id'=>'required|numeric'
            ]);
            if(!Auth::user()){//判断是否登录
                return response()->json(['error'=>1,'text'=>'未登录']);
            }
            $active_id=$request->active_id;
            if(Auth::user()->activeGood($active_id)){//判断用户是否已经购买过了
                return response()->json(['error'=>1,'text'=>'请不要重复提交订单']);
            }
            $active=Active::find($active_id);
            if(!$active||!$active->checkTime()){//验证活动信息
                return response()->json(['error'=>1,'text'=>'活动还没有开始']);
            }
            $num_total=$price_total=$price_discount=0;
            DB::beginTransaction();//开启事务，更新库存，创建订单
            try{
                foreach ($request->goods as $i=>$good){//验证商品信息
                    $good_info=Good::find($good['id']);
                    if(!$good_info){
                        return response()->json(['error'=>1,'text'=>'商品信息异常']);
                    }
                    $num=$good['num'];
                    if(!$good_info->checkNum($num)){//验证商品库存
                        return response()->json(['error'=>1,'text'=>'商品库存不足']);
                    }
                    if(!$good_info->updateNum($num)){
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
            return response()->json(['error'=>0,'text'=>'成功']);
        }
    }
}
