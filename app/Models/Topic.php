<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $fillable=['name'];
    //专题文章模型
    public function topicPosts(){
        return $this->belongsToMany(Post::class,'post_topics',"topic_id",'post_id');
    }
}
