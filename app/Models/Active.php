<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Active extends Model
{
    //
    protected $fillable=['title','time_begin','time_end','status','ip'];
    //商品关联
    public function Goods(){
        return $this->hasMany(Good::class,'active_id','id');
    }
    //增加所属商品
    public function addGoods($goods,$price_discount){
        foreach ($goods as $good){
            $good->price_discount=$price_discount;
        }
        return $this->Goods()->saveMany($goods);
    }
    //验证活动是否开始
    public function checkTime(){
        return Carbon::now()->between(Carbon::createFromTimestamp($this->time_begin),Carbon::createFromTimestamp($this->time_end));
    }
}
