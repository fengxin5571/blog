<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //用户文章
    public function posts(){
        return $this->hasMany(Post::class,"user_id","id");
    }
    //关注我的fan模型
    public function fans(){
        return $this->belongsToMany(User::class,'fans','star_id','fan_id');
    }
    //我关注的用户
    public function stars(){
        return $this->belongsToMany(User::class,'fans','fan_id','star_id');
        //return $this->hasMany(Fan::class,'fan_id','id');
    }
    //关注用户
    public function doFan($user_id){
        //return $this->stars()->create(['star_id'=>$user_id]);
        if(!is_array($user_id)){
            $user_id=compact('user_id');
        }
        return $this->stars()->sync($user_id,false);
    }
    //取消关注
    public function doUnFan($user_id){
        //return $this->stars()->where('star_id',$user_id)->delete();
        if(!is_array($user_id)){
            $user_id=compact('user_id');
            return $this->stars()->detach($user_id);
        }
    }
    public function isFan($user_id){
        return $this->stars->contains($user_id);
    }
    //用户收到的通知
    public  function notices(){
        return $this->belongsToMany(Notice::class,'user_notice','user_id','notice_id')->withPivot('user_id','notice_id');
    }
    //用户增加通知
    public function addNotice($notice){
        return $this->notices()->save($notice);
    }
}
