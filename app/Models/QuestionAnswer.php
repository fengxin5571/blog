<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    //问题描述问题答案模型
    protected $table='question_answer';
    protected $fillable=['question_title','question_answer','question_id'];

}
