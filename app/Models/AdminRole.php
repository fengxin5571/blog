<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $fillable=['name','description'];
    //角色的所有权限
    public function permissions(){
        return $this->belongsToMany(AdminPermission::class,'admin_permission_role','role_id','permission_id')->withPivot('permission_id','role_id');
    }
    //角色赋予权限
    public function assigePermission($permission){
        return $this->permissions()->sync($permission);

    }
    //取消角色权限
    public function deletePermission($permission){
        return $this->permissions()->detach($permission);
    }
    //判断角色是否有权限
    public function hasPermission($permission){
        return $this->permissions->contains($permission);
    }
}
