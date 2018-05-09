<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class AdminUser extends Authenticatable
{
    //后台管理用户模型
    protected $fillable=['name','password'];
    protected $hidden=['password','remember_token'];

}
