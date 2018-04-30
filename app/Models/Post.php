<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
/*
 * 文章模型
 */
class Post extends Authenticatable

{
    use Notifiable;
    //
    protected  $fillable=[
        'title','content',"user_id"];
    public function user(){
       return $this->belongsTo(User::class,'user_id','id');
    }
}
