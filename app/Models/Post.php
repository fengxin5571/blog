<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/*
 * 文章模型
 */
class Post extends Model
{
    //
    protected  $fillable=[
        'title','content',"user_id"];
}
