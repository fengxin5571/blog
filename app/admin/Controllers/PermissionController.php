<?php
/**
 * Created by PhpStorm.
 * User: fengxin
 * Date: 2018/5/12
 * Time: 下午5:34
 */
namespace App\admin\Controllers;
use App\Models\AdminPermission;
use Illuminate\Http\Request;

class PermissionController extends Controller{
    //权限列表
    public function list(){
        $permissions=AdminPermission::all();
        return view('admin.permission.index',compact('permissions'));
    }
    //增加权限
    public function add(Request $request){
        if($request->isMethod('post')){
            $data=$this->validate($request,[
                'name'=>'required',
                'description'=>'required|String'
            ]);
            AdminPermission::create($data);
            return redirect()->route('admin.permisssion');
        }
        return view('admin.permission.add');
    }
}