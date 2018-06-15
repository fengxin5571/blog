<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //问题描述模型
    protected $fillable=['question'];
    //问题所属的答案项
    public function question_answers(){
        return $this->hasMany(QuestionAnswer::class,'question_id','id');
    }
}
