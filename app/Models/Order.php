<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable=['active_id','goods_id','num_total','price_total','price_discount','time_confirm','time_pay','time_over','time_cancel','goods_info','status','ip','uid'];
    //订单用户信息
    public function user(){
        return $this->belongsTo(User::class,'uid','id');
    }
    //订单所属的活动
    public function active(){
        return $this->belongsTo(Active::class,'active_id','id');
    }
    //状态
    public function getStatus(){
        $order_status=array(
            0 => '初始状态',
            1 => '待支付',
            2 => '已支付',
            3 => '已过期',
            4 => '管理员已确认',
            5 => '已取消',
            6 => '已删除',
            7 => '已发货',
            8 => '已收货',
            9 => '已完成',
        );
        return $order_status;
    }
}
