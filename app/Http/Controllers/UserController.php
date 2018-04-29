<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //注册页面
    public function index(){
        return view('users.register');
    }
    //处理注册
    public function register(Request $request){
        $this->validate($request,[
            'name'=>'required|min:3|unique:users,name',
            'email'=>"required|email|unique:users,email",
            'password'=>'required|min:6|confirmed|max:10'
        ]);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
    }
    //用户登录
    public function login(Request $request){
        
        if($request->isMethod("post")){//如果是post提交
        }
        return view("users.login");
    }
    //用户中心
    public function center(User $user){
        
    }
}
