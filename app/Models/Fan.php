<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    //
    protected $fillable=['fan_id','star_id'];
    //粉丝用户
    public function fuser(){
        return $this->hasOne(User::class,'id','fan_id');
    }
    //被关注的用户
    public function suser(){
        return $this->hasOne(User::class,'id',"star_id");
    }
}
