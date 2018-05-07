<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;

/*
 * 文章模型
 */
class Post extends Authenticatable

{
    use Notifiable;
    use Searchable;
    //
    protected  $fillable=[
        'title','content',"user_id"
    ];

    public function searchableAs()
    {
        return 'post';
    }

    // 定义有那些字段需要搜索
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
    //与用户的模型关联
    public function user(){
       return $this->belongsTo(User::class,'user_id','id');
    }
    //与评论的一对多关联
    public function comments(){
        return $this->hasMany(Comment::class,'post_id','id')->orderBy('created_at','desc');
    }
    //返回一个用户的赞模型
    public function zan($user_id){
        return $this->hasOne(Zan::class)->where('user_id',$user_id);
    }
    //此文章的全部赞关联
    public function zans(){
        return $this->hasMany(Zan::class,"post_id",'id');
    }
}
