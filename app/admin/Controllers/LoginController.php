<?php
/**
 * Created by PhpStorm.
 * User: fengxin
 * Date: 2018/5/8
 * Time: 上午11:13
 */
namespace App\admin\Controllers;
use App\Http\Requests\AdminRequest;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{
    public function __construct()
    {
        $this->middleware('guest:admin',['only'=>['login']]);
    }

    //登陆
    public function login(Request $request){
        if($request->isMethod('post')){//处理登陆
            $data=$this->validate($request,[
                'name'=>'required|min:3',
                'password'=>'required|min:6'
            ],[
                'name.required'=>'管理员姓名不能为空',
                'password.required'=>'管理员密码不能为空'
                ]);
            if(Auth::guard('admin')->attempt($data)){
                return response()->json(['message'=>0,'url'=>'/admin/home']);
            }
            return response()->json(['message'=>1,'text'=>'用户名密码不正确']);

        }
        return view('admin.login.login');
    }
    //登出
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}