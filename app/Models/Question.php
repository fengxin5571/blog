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
    //添加所属的问题项
    public function addAnswers($answers){
        return $this->question_answers()->createMany($answers);
    }
    //获取随机问题
    public function randQuestion(){
        return $this->question_answers->random();
    }
}
