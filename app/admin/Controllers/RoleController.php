<?php
/**
 * Created by PhpStorm.
 * User: fengxin
 * Date: 2018/5/12
 * Time: 下午3:51
 */
namespace App\admin\Controllers;
use App\Models\AdminPermission;
use App\Models\AdminRole;
use App\Models\AdminUser;
use Illuminate\Http\Request;

class RoleController extends Controller{
    //权限列表
    public function list(){
        $roles=AdminRole::all();
        return view('admin.roles.index',compact('roles'));
    }
    //增加权限
    public function add(Request $request){
        if($request->isMethod('post')){//添加处理
            $data=$this->validate($request,[
                'name'=>'required|unique:admin_roles,name',
                'description'=>'required|min:3'
            ]);
            AdminRole::create($data);
            return redirect()->route('admin.roles');

        }
        return view('admin.roles.add');
    }
    //角色权限
    public function rolePermission(AdminRole $role){
        $permissions=AdminPermission::all();
        return view('admin.roles.permission');
    }
}