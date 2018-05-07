<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=[
        'content','post_id','user_id'
    ];
    //
    public function post(){
        return $this->belongsTo(Post::class,"post_id",'id')->orderBy('created_at','desc');

    }
    //评论所属用户反向
    public function user(){
        return $this->belongsTo(User::class,'user_id',"id");
    }
}
