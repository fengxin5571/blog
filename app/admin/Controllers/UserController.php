<?php
/**
 * Created by PhpStorm.
 * User: fengxin
 * Date: 2018/5/9
 * Time: 下午2:30
 */
namespace App\admin\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;

class UserController extends Controller{
    //管理用户
    public function index(){
        $adminusers=AdminUser::orderBy('created_at','desc')->Paginate(20);
        return view('admin.users.index',compact('adminusers'));
    }
    //增加用户
    public function add(Request $request){
        if($request->isMethod('post')){//添加用户
            $this->validate($request,[
                'name'=>'required|min:3|max:10|unique:admin_users,name',
                'password'=>'required|min:6'
            ]);
            AdminUser::create([
                'name'=>$request->name,
                 'password'=>bcrypt($request->password),
            ]);
            return redirect()->route('admin.users');

        }
        return view('admin.users.add');
    }
}