<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',['only'=>['index','login']]);
    }

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
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        Auth::login($user);
        return redirect()->route("posts.list");
    }
    //用户登录
    public function login(Request $request){
        
        if($request->isMethod("post")){//如果是post提交
            $data=$this->validate($request,[
                'email'=>"required|email",
                'password'=>"required|min:6|max:10"
            ]);
            if(Auth::attempt($data,$request->is_remember)){//验证是否登陆成功
                return redirect()->route('posts.list');
            }
            return redirect()->back()->withErrors("用户名或密码错误！");
        }
        return view("users.login");
    }
    //用户中心
    public function center(User $user){
        
    }
    //用户登出
    public function logout(){
        Auth::logout();
        return redirect()->route("login");
    }
}
