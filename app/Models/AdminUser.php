<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

class AdminUser extends Authenticatable
{
    use Notifiable;
    //后台管理用户模型
    protected $fillable=['name','password'];
    protected $hidden=['password','remember_token'];
    //用户有哪些角色
    public function roles(){
        return $this->belongsToMany(AdminRole::class,'admin_role_user','user_id','role_id')->withPivot('user_id','role_id');
    }
    //是否有某些角色
    public function isInroles($roles){
        if($roles instanceof Collection){
            return $this->roles->intersect($roles)->count();

        }else{
            return $this->roles->contains($roles);
        }

    }
    //给用户分配角色
    public function assigeRole($roles){
        return $this->roles()->sync($roles);
    }
    //取消用户分配的角色
    public function deleteRole($roles){
        return $this->roles()->detach($roles);
    }
    //用户是否有权限
    public function hasPermission($permission){
       return $this->isInroles($permission->roles);
    }
}
