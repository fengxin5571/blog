<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
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
    public static function boot(){
        parent::boot();
        static::addGlobalScope('scuess_status',function (Builder $builder){
            $builder->where('status','=','1');
        });
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
    public function postTopics(){
        return $this->hasMany(PostTopic::class,'post_id',"id");
    }
    //属于某个作者的文章
    public function scopeAuthorBy($query,$user_id){//本地查询作用域
        return $query->where('user_id',$user_id);
    }
    //不属于某个专题的文章
    public function scopeTopicNot($query,$topic_id){
        return $query->doesntHave('postTopics','and',function ($q)use ($topic_id){//不存在的关联查询
            $q->where('topic_id',$topic_id);
        });

    }
}
